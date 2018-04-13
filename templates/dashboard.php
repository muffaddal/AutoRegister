<?php require_once('../templates/layouts/bootstrap.php');

use app\Classes\AutoModel;

$listings = (new AutoModel())->get();

if(isset($_GET['manufacturer']) && $_GET['manufacturer'] == 'true'){
    echo '<script>alert("manufacturer added successfully!");window.location.pathname.split("/").pop();
 </script>';
}
?>
<div class="col-md-12 top-buffer">
    <h1>
        Dashboard
    </h1>
    <hr>
    </hr>
</div>
<div class="col-md-12 main_container">
    <table class="table table-hover" id="listing_table">
        <thead>
            <tr>
                <th>
                    Serial No:
                </th>
                <th>
                    Manufacturer Name
                </th>
                <th>
                    Model Name
                </th>
                <th>
                    Count
                </th>
                <th>
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
        	<?php 
        	
        	$serial = 1;

        	foreach ($listings as $key => $list) {
        		echo "<tr id='model_row_$list[id]'>
        		<td>$serial.</td>
        		<td>$list[mfg_name]</td>
        		<td>$list[model_name]</td>
        		<td>---</td>
        		<td><button type='button' class='btn btn-primary view_details' data-toggle='modal' data-target='#myModal_$list[id]' DB-id='$list[id]'>View Details</button></td>
        		</tr>";
        	
        		$serial++;
        	}
        	 ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" type="button">
                    ×
                </button>
                <h4 class="modal-title">
                    Car Details
                </h4>
            </div>
            <div class="modal-body" style="overflow: auto;">
            	 <table class="table">
				    <tbody>
				        <tr>
				          <th>Manufacturer:</th>
				            <td id="mfg_name"></td>
				        </tr>
				        <tr>
				          <th>Model:</th>
				            <td id="model_name"></td>
				        </tr>
				        <tr>
				          <th>Color:</th>
				            <td id="color"></td>
				        </tr>
				        <tr>
				          <th>Year:</th>
				            <td id="year"></td>
				        </tr>
				        <tr>
				          <th>Sold Status:</th>
				            <td id="sold_status"></td>
				        </tr>
				        <tr>
				          <th>Registration Number:</th>
				            <td id="reg_number"></td>
				        </tr>
						<tr>
				          <th>Images</th>
				            <td id="images">
				            	<img id="model_img_0" src="" alt="Image" height="200" width="300">
				            	<img id="model_img_1" src="" class="top-buffer" alt="Image" height="200" width="300" style="display: none;">
				           	</td>
				        </tr>
				        <tr>
				          <th>Note:</th>
				            <td id="note"></td>
				        </tr>
				    </tbody>
				</table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

</script>