<?php require_once 'layouts/bootstrap.php';

use app\Classes\AutoManufacturer as mfg;

$manufacturers = (new mfg())->getData();

?>

<div class="col-md-12 top-buffer bottom-buffer">

    <h1>Add Model</h1>
    <hr/>

    <div class="row">
        <div class="alert alert-success" id="modelSuccess" style="display: none;">
            <strong>Success!</strong> Model Added Successfully</div>

        <div class="alert alert-danger" id="modelFailure" style="display: none;">
            <strong>Failure!</strong> Failed to add data</div>

    </div>

    <form autocomplete="off" id="makeModel" method="POST" enctype="multipart/form-data">
        <div class="form-group col-md-6">
            <label for="name">Model Name:</label>
            <input class="form-control" id="name" name="name" maxlength="255" pattern="^[a-zA-Z ]*$" required title="Invalid Input" type="text"/>
        </div>

        <div class="form-group col-md-6">
            <label for="manufacturer_id">Select Manufacturer:</label>
            <select class="form-control" name="manufacturer_id" id="manufacturer_id" required>
                <option></option>
                <?php foreach ($manufacturers as $key => $mfg) {
                    echo "<option value='$mfg[id]'>" . ucfirst($mfg['name']) . "</option>";
                } ?>
            </select>
        </div>        

        <div class="form-group col-md-6">
            <label for="year">Manufacturing Year:</label>
            <select class="form-control" name="year" id="year" required>
                <option></option>
                <option>Vintage</option>
            <?php for ($i = date("Y") - 15; $i <= date("Y"); $i++) { 
                echo "<option>$i</option>";
            }?>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="reg_number">Registration Number:</label>
            <input class="form-control" id="reg_number" name="reg_number" pattern="^[a-zA-Z 0-9]*$" required title="Invalid Input" maxlength="255" type="text"/>
        </div>

        <div class="form-group col-md-6">
            <label for="color">Color:</label>
            <input class="form-control" id="color" name="color" maxlength="255" pattern="^[a-zA-Z ]*$" required title="Invalid Input" type="text"/>
        </div>

        <div class="col-md-6 form-group">
            <label for="simage">Upload Images</label>
            <span class="btn btn-default btn-file">
                Browse…
                <input id="images" name="images" type="file" multiple required/>
            </span>
        </div>

        <div class="form-group col-md-12">
            <label for="note">Notes:</label>
            <textarea class="form-control" name="note" maxlength="1000" id="note" rows="8" required></textarea>
        </div>

        <div class="col-md-8 text-center submit-btn">
            <button class="btn btn-primary col-lg-4" name="Submit" type="submit" value="Submit">
                Submit
            </button>
        </div>

    </form>
</div>
