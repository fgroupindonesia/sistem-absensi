<?php $rnum = "?" . rand(1000, 9999); 
// ini untuk memudahkan all Script JS bawahan
echo "<script>var URL_MAIN_PORTAL = '". base_url() . "'; </script>";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>My Account - Settings - Sistem Absensi Digital.</title>
    <!-- CSS files -->
    <link href="<?=base_url();?>/assets/css/tabler.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-flags.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-payments.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/tabler-vendors.min.css<?=$rnum?>" rel="stylesheet"/>
    <link href="<?=base_url();?>/assets/css/demo.min.css<?=$rnum?>" rel="stylesheet"/>
    <style>
      @import url('<?=base_url();?>/assets/css/inter.css');
      :root {
      	--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>
  </head>
  <body >
    <script src="<?=base_url();?>/assets/js/demo-theme.min.js<?=$rnum?>"></script>
    <div class="page">
      <!-- Navbar -->
       <?php include('header.php'); ?>
       <?php if($akses->isCompany()) : include('nav_bar.php'); endif; ?>
       <?php if($akses->isAdmin()) : include('superadmin_nav_bar.php'); endif; ?>
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Settings
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
           <form action="<?= base_url('portal/settings/update') ;?>" method="post" id="admin-settings">
            <input type="hidden" id="id-user" name="id" value="<?= $akses->getData('id'); ?>" >
       <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                <?php include('nav_settings.php'); ?>
                </div>


                <div class="col d-flex flex-column">
                  <div class="card-body">

                    <h2 class="mb-4">My Account</h2>
                    <h3 class="card-title">Profile Details</h3>
                    <div class="row align-items-center">
                      <div class="col-auto"><img class="avatar avatar-xl" src="<?=base_url();?>/assets/img/avatars/<?= $this->akses->getAvatar() ;?>" >
                      </div>
                      <div class="col-auto"><a id="btn-change-avatar" href="#" class="btn">
                          Change avatar
                        </a></div>
                      <div class="col-auto"><a id="btn-delete-avatar" href="#" class="btn d-none btn-ghost-danger">
                          Delete avatar
                        </a></div>
                    </div>
                    <h3 class="card-title mt-4">Login Access</h3>
                    <div class="row g-3">
                    
                      <div class="col-md">
                        <div class="form-label">Username</div>
                        <input type="text" class="form-control" value="<?= $akses->getData('username');?>">
                      </div>
                      <div class="col-md">
                        <div class="form-label">Tanggal Terdaftar</div>
                        <label><?= tanggal_indonesia($akses->getData('date_created'));?> </label>
                      </div>
                    </div>
                    <h3 class="card-title mt-4">Email</h3>
                    <p class="card-subtitle">Email ini yang digunakan login.</p>
                    <div>
                      <div class="row g-2">
                        <div class="col-auto">
                          <input type="text" class="form-control w-auto" value="<?= $akses->getData('email');?>">
                        </div>
                       
                      </div>
                    </div>
                    <h3 class="card-title mt-4">Password</h3>
                    <p class="card-subtitle">Pembaharuan password dapat dilakukan dari sini.</p>
                    <div>
                      <a href="#" id="btn-change-pass" class="btn">
                        Set new password
                      </a>
                    </div>
                    <h3 class="card-title mt-4">Bio</h3>
                    <p class="card-subtitle">Data bio akan terlihat di publik.</p>
                    <div>
                      <div class="row">
                        <div class="col-6">
                          <textarea class="form-control col-6" col="130" row="50"><?= $akses->getData('bio');?></textarea>
                        </div>
                       
                      </div>
                    </div>
                    <h3 class="card-title mt-4">Business Profile</h3>
                    <div class="row g-3">
                    
                      <div class="col-md">
                        <div class="form-label">Country</div>
                        <select name="country" class="form-select" id="country">
  <option value="">Pilih Negara</option>
  <option value="AF">Afghanistan</option>
  <option value="AL">Albania</option>
  <option value="DZ">Algeria</option>
  <option value="AD">Andorra</option>
  <option value="AO">Angola</option>
  <option value="AG">Antigua and Barbuda</option>
  <option value="AR">Argentina</option>
  <option value="AM">Armenia</option>
  <option value="AU">Australia</option>
  <option value="AT">Austria</option>
  <option value="AZ">Azerbaijan</option>
  <option value="BS">Bahamas</option>
  <option value="BH">Bahrain</option>
  <option value="BD">Bangladesh</option>
  <option value="BB">Barbados</option>
  <option value="BY">Belarus</option>
  <option value="BE">Belgium</option>
  <option value="BZ">Belize</option>
  <option value="BJ">Benin</option>
  <option value="BT">Bhutan</option>
  <option value="BO">Bolivia</option>
  <option value="BA">Bosnia and Herzegovina</option>
  <option value="BW">Botswana</option>
  <option value="BR">Brazil</option>
  <option value="BN">Brunei</option>
  <option value="BG">Bulgaria</option>
  <option value="BF">Burkina Faso</option>
  <option value="BI">Burundi</option>
  <option value="CV">Cabo Verde</option>
  <option value="KH">Cambodia</option>
  <option value="CM">Cameroon</option>
  <option value="CA">Canada</option>
  <option value="CF">Central African Republic</option>
  <option value="TD">Chad</option>
  <option value="CL">Chile</option>
  <option value="CN">China</option>
  <option value="CO">Colombia</option>
  <option value="KM">Comoros</option>
  <option value="CG">Congo, Republic of the</option>
  <option value="CD">Congo, Democratic Republic of the</option>
  <option value="CR">Costa Rica</option>
  <option value="HR">Croatia</option>
  <option value="CU">Cuba</option>
  <option value="CY">Cyprus</option>
  <option value="CZ">Czech Republic</option>
  <option value="DK">Denmark</option>
  <option value="DJ">Djibouti</option>
  <option value="DM">Dominica</option>
  <option value="DO">Dominican Republic</option>
  <option value="EC">Ecuador</option>
  <option value="EG">Egypt</option>
  <option value="SV">El Salvador</option>
  <option value="GQ">Equatorial Guinea</option>
  <option value="ER">Eritrea</option>
  <option value="EE">Estonia</option>
  <option value="SZ">Eswatini</option>
  <option value="ET">Ethiopia</option>
  <option value="FJ">Fiji</option>
  <option value="FI">Finland</option>
  <option value="FR">France</option>
  <option value="GA">Gabon</option>
  <option value="GM">Gambia</option>
  <option value="GE">Georgia</option>
  <option value="DE">Germany</option>
  <option value="GH">Ghana</option>
  <option value="GR">Greece</option>
  <option value="GD">Grenada</option>
  <option value="GT">Guatemala</option>
  <option value="GN">Guinea</option>
  <option value="GW">Guinea-Bissau</option>
  <option value="GY">Guyana</option>
  <option value="HT">Haiti</option>
  <option value="HN">Honduras</option>
  <option value="HU">Hungary</option>
  <option value="IS">Iceland</option>
  <option value="IN">India</option>
  <option value="ID">Indonesia</option>
  <option value="IR">Iran</option>
  <option value="IQ">Iraq</option>
  <option value="IE">Ireland</option>
  <option value="IL">Israel</option>
  <option value="IT">Italy</option>
  <option value="JM">Jamaica</option>
  <option value="JP">Japan</option>
  <option value="JO">Jordan</option>
  <option value="KZ">Kazakhstan</option>
  <option value="KE">Kenya</option>
  <option value="KI">Kiribati</option>
  <option value="KP">North Korea</option>
  <option value="KR">South Korea</option>
  <option value="KW">Kuwait</option>
  <option value="KG">Kyrgyzstan</option>
  <option value="LA">Laos</option>
  <option value="LV">Latvia</option>
  <option value="LB">Lebanon</option>
  <option value="LS">Lesotho</option>
  <option value="LR">Liberia</option>
  <option value="LY">Libya</option>
  <option value="LI">Liechtenstein</option>
  <option value="LT">Lithuania</option>
  <option value="LU">Luxembourg</option>
  <option value="MG">Madagascar</option>
  <option value="MW">Malawi</option>
  <option value="MY">Malaysia</option>
  <option value="MV">Maldives</option>
  <option value="ML">Mali</option>
  <option value="MT">Malta</option>
  <option value="MH">Marshall Islands</option>
  <option value="MR">Mauritania</option>
  <option value="MU">Mauritius</option>
  <option value="MX">Mexico</option>
  <option value="FM">Micronesia</option>
  <option value="MD">Moldova</option>
  <option value="MC">Monaco</option>
  <option value="MN">Mongolia</option>
  <option value="ME">Montenegro</option>
  <option value="MA">Morocco</option>
  <option value="MZ">Mozambique</option>
  <option value="MM">Myanmar</option>
  <option value="NA">Namibia</option>
  <option value="NR">Nauru</option>
  <option value="NP">Nepal</option>
  <option value="NL">Netherlands</option>
  <option value="NZ">New Zealand</option>
  <option value="NI">Nicaragua</option>
  <option value="NE">Niger</option>
  <option value="NG">Nigeria</option>
  <option value="MK">North Macedonia</option>
  <option value="NO">Norway</option>
  <option value="OM">Oman</option>
  <option value="PK">Pakistan</option>
  <option value="PW">Palau</option>
  <option value="PA">Panama</option>
  <option value="PG">Papua New Guinea</option>
  <option value="PY">Paraguay</option>
  <option value="PE">Peru</option>
  <option value="PH">Philippines</option>
  <option value="PL">Poland</option>
  <option value="PT">Portugal</option>
  <option value="QA">Qatar</option>
  <option value="RO">Romania</option>
  <option value="RU">Russia</option>
  <option value="RW">Rwanda</option>
  <option value="KN">Saint Kitts and Nevis</option>
  <option value="LC">Saint Lucia</option>
  <option value="VC">Saint Vincent and the Grenadines</option>
  <option value="WS">Samoa</option>
  <option value="SM">San Marino</option>
  <option value="ST">Sao Tome and Principe</option>
  <option value="SA">Saudi Arabia</option>
  <option value="SN">Senegal</option>
  <option value="RS">Serbia</option>
  <option value="SC">Seychelles</option>
  <option value="SL">Sierra Leone</option>
  <option value="SG">Singapore</option>
  <option value="SK">Slovakia</option>
  <option value="SI">Slovenia</option>
  <option value="SB">Solomon Islands</option>
  <option value="SO">Somalia</option>
  <option value="ZA">South Africa</option>
  <option value="SS">South Sudan</option>
  <option value="ES">Spain</option>
  <option value="LK">Sri Lanka</option>
  <option value="SD">Sudan</option>
  <option value="SR">Suriname</option>
  <option value="SE">Sweden</option>
  <option value="CH">Switzerland</option>
  <option value="SY">Syria</option>
  <option value="TJ">Tajikistan</option>
  <option value="TZ">Tanzania</option>
  <option value="TH">Thailand</option>
  <option value="TL">Timor-Leste</option>
  <option value="TG">Togo</option>
  <option value="TO">Tonga</option>
  <option value="TT">Trinidad and Tobago</option>
  <option value="TN">Tunisia</option>
  <option value="TR">Turkey</option>
  <option value="TM">Turkmenistan</option>
  <option value="TV">Tuvalu</option>
  <option value="UG">Uganda</option>
  <option value="UA">Ukraine</option>
  <option value="AE">United Arab Emirates</option>
  <option value="GB">United Kingdom</option>
  <option value="US">United States</option>
  <option value="UY">Uruguay</option>
  <option value="UZ">Uzbekistan</option>
  <option value="VU">Vanuatu</option>
  <option value="VE">Venezuela</option>
  <option value="VN">Vietnam</option>
  <option value="YE">Yemen</option>
  <option value="ZM">Zambia</option>
  <option value="ZW">Zimbabwe</option>
</select>
                      </div>
                       <div class="col-md">
                        <input type='hidden' id='hidden-selectedRegion' value='<?= $akses->getData("region"); ?>' >
                        <div class="form-label">Region</div>
                        <select id="region" class="form-select" >
                          <option></option>
                        </select>
                      </div>
                      <div class="col-md">
                        <input type='hidden' id='hidden-selectedCity' value='<?= $akses->getData("city"); ?>' >
                        
                        <div class="form-label">City</div>
                         <select id="city" class="form-select" >
                          <option></option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                    <div class="col-6">
                        <div class="form-label">Address</div>
                        <textarea class="form-control col-6" ><?= $akses->getData('address'); ?></textarea>
                      </div>
                    </div>
                    <h3 class="card-title mt-4">Public profile</h3>
                    <p class="card-subtitle">Making your profile public means that anyone on the Dashkit network will be able to find
                      you.</p>
                    <div>
                      <label class="form-check form-switch form-switch-lg">
                        <input class="form-check-input" type="checkbox" <?= $akses->getData('public_profile') == 1 ? 'checked' : ''?> >
                        <span class="form-check-label form-check-label-on">You're currently visible</span>
                        <span class="form-check-label form-check-label-off">You're
                          currently invisible</span>
                      </label>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                      <a href="#" class="btn">
                        Cancel
                      </a>
                      <a href="#" id="btn-submit" class="btn btn-primary">
                        Submit
                      </a>
                    </div>
                  </div>

                </div>
              

              </div>
            </div>
          </div>
        </div>
      </form>

       <?php include('footer.php'); ?>
      </div>
    </div>
     <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?=base_url();?>/assets/js/jquery-3.7.1.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>/assets/js/tabler.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>/assets/js/demo.min.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>/assets/js/sweetalert2@11.js<?=$rnum?>" ></script>
    <script src="<?=base_url();?>/assets/js/admin-settings.js<?=$rnum?>" ></script>
    <!-- custom script -->
    <script>
       $(document).ready(function() {
        var selectedCountry = '<?= $akses->getData('country') ?>';
        var selectedRegion = '<?= $akses->getData('region') ?>';
        var selectedCity = '<?= $akses->getData('city') ?>';
        
        $('#country').val(selectedCountry).trigger('change'); // trigger untuk load region

        // Tunggu region di-load setelah country
        $('#country').on('loadedRegion', function () {
            $('#region').val(selectedRegion).trigger('change'); // trigger untuk load city
        });

        // Tunggu city di-load setelah region
        $('#region').on('loadedCity', function () {
            $('#city').val(selectedCity);
        });

      });  
    </script>

  </body>
</html>