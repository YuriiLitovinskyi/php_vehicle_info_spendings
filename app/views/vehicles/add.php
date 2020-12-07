<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT ?>/vehicles" class="btn btn-link"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light my-5 form-card">
    <h2>Add New Vehicle</h2>
    <p>You can add your new vehicle with this form</p>
    <form action="<?php echo URLROOT; ?>/vehicles/add" method="POST">

        <div class="form-group">
            <label for="name">Vehicle Brand: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="producing_country">Vehicle Producing Country: <sup>*</sup></label>
            <input type="text" name="producing_country" class="form-control form-control-lg <?php echo (!empty($data['producing_country_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['producing_country']; ?>">
            <span class="invalid-feedback"><?php echo $data['producing_country_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="year_production">Vehicle Year Production: <sup>*</sup></label>
            <input type="number" min="1900" max="2099" step="1" name="year_production" class="form-control form-control-lg <?php echo (!empty($data['year_production_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['year_production']; ?>">
            <span class="invalid-feedback"><?php echo $data['year_production_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="car_mileage">Current Vehicle Mileage: <sup>*</sup></label>
            <input type="text" name="car_mileage" class="form-control form-control-lg <?php echo (!empty($data['car_mileage_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['car_mileage']; ?>">
            <span class="invalid-feedback"><?php echo $data['car_mileage_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="fuel">Vehicle Fuel Type: <sup>*</sup></label>          
            <select name="fuel" class="custom-select <?php echo (!empty($data['fuel_error'])) ? 'is-invalid' : ''; ?>">
                <option selected value="">Choose Fuel Type</option>
                <option value="Gasoline">Gasoline</option>
                <option value="Diesel">Diesel</option>
                <option value="Gas">Gas</option>
                <option value="Other">Other</option>
            </select>
            <span class="invalid-feedback"><?php echo $data['fuel_error']; ?></span>       
        </div>

        <div class="form-group">
            <label for="transmission">Vehicle Transmission Type: <sup>*</sup></label>
            <input type="text" name="transmission" class="form-control form-control-lg <?php echo (!empty($data['transmission_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['transmission']; ?>">
            <span class="invalid-feedback"><?php echo $data['transmission_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="configuration">Vehicle Body Type: <sup>*</sup></label>
            <input type="text" name="configuration" class="form-control form-control-lg <?php echo (!empty($data['configuration_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['configuration']; ?>">
            <span class="invalid-feedback"><?php echo $data['configuration_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="vin_number">Vehicle VIN Number: <sup>*</sup></label>
            <input type="text" name="vin_number" class="form-control form-control-lg <?php echo (!empty($data['vin_number_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['vin_number']; ?>">
            <span class="invalid-feedback"><?php echo $data['vin_number_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="engine_capacity">Vehicle Engine Capacity: <sup>*</sup></label>
            <input type="text" name="engine_capacity" class="form-control form-control-lg <?php echo (!empty($data['engine_capacity_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['engine_capacity']; ?>">
            <span class="invalid-feedback"><?php echo $data['engine_capacity_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="color">Vehicle Color: <sup>*</sup></label>
            <input type="text" name="color" class="form-control form-control-lg <?php echo (!empty($data['color_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['color']; ?>">
            <span class="invalid-feedback"><?php echo $data['color_error']; ?></span>
        </div>        

        <div class="form-group">
            <label for="vehicle_mass">Vehicle Mass: <sup>*</sup></label>
            <input type="text" name="vehicle_mass" class="form-control form-control-lg <?php echo (!empty($data['vehicle_mass_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['vehicle_mass']; ?>">
            <span class="invalid-feedback"><?php echo $data['vehicle_mass_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="maximum_mass">Vehicle Maximum Mass: <sup>*</sup></label>
            <input type="text" name="maximum_mass" class="form-control form-control-lg <?php echo (!empty($data['maximum_mass_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['maximum_mass']; ?>">
            <span class="invalid-feedback"><?php echo $data['maximum_mass_error']; ?></span>
        </div>

        <input type="submit" class="btn btn-success" value="Submit">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>