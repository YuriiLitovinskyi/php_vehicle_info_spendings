<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT ?>/vehicles" class="btn btn-link"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light my-5 form-card">
    <h2>Add New Vehicle</h2>
    <p>You can add your new vehicle with this form</p>
    <form action="<?php echo URLROOT; ?>/vehicles/add" method="POST">

        <div class="form-group">
            <label for="name">Vehicle Brand: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control <?php echo (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="producing_country">Vehicle Producing Country: <sup>*</sup></label>
            <input type="text" name="producing_country" class="form-control form-control <?php echo (!empty($data['producing_country_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['producing_country']; ?>">
            <span class="invalid-feedback"><?php echo $data['producing_country_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="year_production">Vehicle Year Production: <sup>*</sup></label>
            <input type="number" name="year_production" class="form-control form-control <?php echo (!empty($data['year_production_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['year_production']; ?>">
            <span class="invalid-feedback"><?php echo $data['year_production_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="car_mileage">Current Vehicle Mileage (km): <sup>*</sup></label>
            <input type="number" name="car_mileage" class="form-control form-control <?php echo (!empty($data['car_mileage_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['car_mileage']; ?>">
            <span class="invalid-feedback"><?php echo $data['car_mileage_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="fuel">Vehicle Fuel Type: <sup>*</sup></label>
            <select name="fuel" class="custom-select <?php echo (!empty($data['fuel_error'])) ? 'is-invalid' : ''; ?>">
                <option selected value="<?php echo (!empty($data['fuel_error'])) ? '' : $data['fuel']; ?>"><?php echo (empty($data['fuel'])) ? 'Select fuel type' : $data['fuel']; ?></option>
                <?php echo ($data['fuel'] == 'Gasoline' ? '' : '<option value="Gasoline">Gasoline</option>') ?>
                <?php echo ($data['fuel'] == 'Diesel' ? '' : '<option value="Diesel">Diesel</option>') ?>
                <?php echo ($data['fuel'] == 'Gas' ? '' : '<option value="Gas">Gas</option>') ?>
                <?php echo ($data['fuel'] == 'Other' ? '' : '<option value="Other">Other</option>') ?>
            </select>
            <span class="invalid-feedback"><?php echo $data['fuel_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="transmission">Vehicle Transmission Type: <sup>*</sup></label>
            <select name="transmission" class="custom-select <?php echo (!empty($data['transmission_error'])) ? 'is-invalid' : ''; ?>">
                <option selected value="<?php echo (!empty($data['transmission_error'])) ? '' : $data['transmission']; ?>"><?php echo (empty($data['transmission'])) ? 'Select transmission type' : $data['transmission']; ?></option>
                <?php echo ($data['transmission'] == 'Manual' ? '' : '<option value="Manual">Manual</option>') ?>
                <?php echo ($data['transmission'] == 'Automatic' ? '' : '<option value="Automatic">Automatic</option>') ?>
                <?php echo ($data['transmission'] == 'Continuously Variable' ? '' : '<option value="Continuously Variable">Continuously Variable</option>') ?>
                <?php echo ($data['transmission'] == 'Other' ? '' : '<option value="Other">Other</option>') ?>
            </select>
            <span class="invalid-feedback"><?php echo $data['transmission_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="configuration">Vehicle Body Type: <sup>*</sup></label>
            <select name="configuration" class="custom-select <?php echo (!empty($data['configuration_error'])) ? 'is-invalid' : ''; ?>">
                <option selected value="<?php echo (!empty($data['configuration_error'])) ? '' : $data['configuration']; ?>"><?php echo (empty($data['configuration'])) ? 'Select configuration type' : $data['configuration']; ?></option>
                <?php echo ($data['configuration'] == 'Sedan' ? '' : '<option value="Sedan">Sedan</option>') ?>
                <?php echo ($data['configuration'] == 'Hatchback' ? '' : '<option value="Hatchback">Hatchback</option>') ?>
                <?php echo ($data['configuration'] == 'Station Wagon' ? '' : '<option value="Station Wagon">Station Wagon</option>') ?>
                <?php echo ($data['configuration'] == 'Sport Car' ? '' : '<option value="Sport Car">Sport Car</option>') ?>
                <?php echo ($data['configuration'] == 'Minivan' ? '' : '<option value="Minivan">Minivan</option>') ?>
                <?php echo ($data['configuration'] == 'Convertible' ? '' : '<option value="Convertible">Convertible</option>') ?>
                <?php echo ($data['configuration'] == 'Sport-utility' ? '' : '<option value="Sport-utility">Sport-utility</option>') ?>
                <?php echo ($data['configuration'] == 'Pichup' ? '' : '<option value="Pichup">Pichup</option>') ?>
                <?php echo ($data['configuration'] == 'Other' ? '' : '<option value="Other">Other</option>') ?>
            </select>
            <span class="invalid-feedback"><?php echo $data['configuration_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="vin_number">Vehicle VIN Number:</label>
            <input type="text" name="vin_number" class="form-control form-control <?php echo (!empty($data['vin_number_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['vin_number']; ?>">
            <span class="invalid-feedback"><?php echo $data['vin_number_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="engine_capacity">Vehicle Engine Capacity (L):</label>
            <input type="text" name="engine_capacity" class="form-control form-control <?php echo (!empty($data['engine_capacity_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['engine_capacity']; ?>">
            <span class="invalid-feedback"><?php echo $data['engine_capacity_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="color">Vehicle Color:</label>
            <input type="text" name="color" class="form-control form-control <?php echo (!empty($data['color_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['color']; ?>">
            <span class="invalid-feedback"><?php echo $data['color_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="vehicle_mass">Vehicle Mass (kg):</label>
            <input type="number" name="vehicle_mass" class="form-control form-control <?php echo (!empty($data['vehicle_mass_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['vehicle_mass']; ?>">
            <span class="invalid-feedback"><?php echo $data['vehicle_mass_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="maximum_mass">Vehicle Maximum Mass (kg):</label>
            <input type="number" name="maximum_mass" class="form-control form-control <?php echo (!empty($data['maximum_mass_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['maximum_mass']; ?>">
            <span class="invalid-feedback"><?php echo $data['maximum_mass_error']; ?></span>
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Vehicle</button>
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>