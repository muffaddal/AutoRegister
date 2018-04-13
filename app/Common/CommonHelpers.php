<?php

namespace app\Common;

class CommonHelpers
{

    /**
     * @param $var
     * @return mixed
     * @author Mufaddal
     */
    public static function checkIfEmpty($var)
    {
        if (is_array($var)) {

            foreach ($var as $key => $input) {
                Self::checkIfEmpty($input);
            }

        } else {
            if (isset($var) && !empty($var) && trim($var)) {
                return $var;
            } else {
                return json_encode("Please check the input");
            }
        }
    }

    /**
     * @param $imageArray
     * @author Mufaddal
     * @return string
     */
    public static function validateImage($imageArray)
    {
        foreach ($imageArray as $key => $images) {

            if (isset($images)) {

                $errors = [];
                $maximumSize = 2097152;

                $acceptableFormats = ['image/jpeg', 'image/jpg', 'image/png'];

                if (($images[ 'size' ] >= $maximumSize) || ($images[ "size" ] == 0)) {
                    $errors[] = 'File too large. File must be less than 2 megabytes.';
                }

                if (( !in_array($images[ 'type' ], $acceptableFormats)) && ( !empty($images[ "type" ]))) {

                    $errors[] = 'Invalid file Format. Only Formats allowed are PDF, JPG, GIF and PNG.';
                }

                if (count($errors) > 0) {

                    foreach ($errors as $error) {
                        return $error;
                    }
                }
            } else {
                return "Please select images";
            }
        }
    }

    public static function checkImage()
    {
        unset($_FILES[ 'images' ]);
        if (count($_FILES) <= 0) {
            echo "Please upload images!";
            die;
        }

        // Allowing only 3 images upload
        if (count($_FILES) > 3) {
            echo "Cannot upload more than 2 files!";
            die;
        }
    }
}
