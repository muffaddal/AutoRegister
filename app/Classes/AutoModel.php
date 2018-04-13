<?php

namespace app\Classes;

use app\DB\DB;

class AutoModel
{

    private $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = (new DB())->getmyDB();
    }

    /**
     * @param string $model_id
     * @return array
     * @author Mufaddaln
     */
    public function get($model_id = '')
    {
        $query = "SELECT
                   mo.id,
                   mfg.name as mfg_name,
                   GROUP_CONCAT(img.img_name) as model_img,
                   mo.name as model_name,
                   mo.reg_number,
                   mo.color,
                   mo.year,
                   mo.note,
                   mo.sold_status
            FROM models as mo
            INNER JOIN manufacturer as mfg ON mfg.id = mo.manufacturer_id
            LEFT JOIN images as img ON img.model_id = mo.id
            WHERE mo.sold_status != 1 ";

        $query .= ( !empty($model_id)) ? " AND mo.id = $model_id " : "";

        $query .= " GROUP BY mo.id ORDER BY mo.created_at DESC ";

        $data = $this->databaseConnection->prepare($query);

        $data->execute();
        $data->setFetchMode(\PDO::FETCH_ASSOC);
        $result = $data->fetchAll();

        return $result;
    }

    /***
     * @param $data
     * @param $fileData
     * @return bool
     * @author Mufaddaln
     */
    public function create($data, $fileData)
    {
        $form_fields = $this->setValidFields($data);

        $stmt = $this->databaseConnection->prepare("INSERT INTO models
            (name,reg_number,manufacturer_id,color,year,note) VALUES
            (:name,:reg_number,:manufacturer_id,:color,:year,:note)");

        $upload_path = dirname(dirname(__DIR__)) . "/resources/images/uploads/";

        $stmt->execute([
            "name"            => $form_fields[ 'name' ],
            "reg_number"      => $form_fields[ 'reg_number' ],
            "manufacturer_id" => $form_fields[ 'manufacturer_id' ],
            "color"           => $form_fields[ 'color' ],
            "year"            => $form_fields[ 'year' ],
            "note"            => $form_fields[ 'note' ],
        ]);

        $model_id = $this->databaseConnection->lastInsertId();

        // Storing Images into a folder | referencing image path in DB
        foreach ($fileData as $key => $img) {

            $extension = pathinfo($img[ 'name' ], PATHINFO_EXTENSION);
            $img_name = time() . rand(111, 999) . "." . $extension;
            $img_path = $upload_path . $img_name;
            move_uploaded_file($img[ 'tmp_name' ], $img_path);
            chmod($img_path, 0777);

            $stmt = $this->databaseConnection->prepare("INSERT INTO images
                    (img_name, model_id) VALUES
                    (:img_name, :model_id)");

            $stmt->execute([
                "img_name" => $img_name,
                "model_id" => $model_id, // last inserted car ID
            ]);
        }

        if ($this->databaseConnection->lastInsertId()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $modelId
     * @return int
     * @author Mufaddal.n
     */
    public function updateSoldStatus($modelId)
    {
        $query = "UPDATE models
                SET sold_status = 1
                WHERE id = :model_id";

        $data = $this->databaseConnection->prepare($query);

        $data->execute([
            "model_id" => $modelId,
        ]);

        return $data->rowCount();
    }

    /**
     * @param $data
     * @return array
     * @author Mufaddaln
     */
    public function setValidFields($data)
    {
        $requiredFields = [
            'name'            => $data[ 'name' ],
            'reg_number'      => $data[ 'reg_number' ],
            'color'           => $data[ 'color' ],
            'note'            => $data[ 'note' ],
            'manufacturer_id' => $data[ 'manufacturer_id' ],
            'year'            => $data[ 'year' ],
        ];

        return $requiredFields;
    }

}
