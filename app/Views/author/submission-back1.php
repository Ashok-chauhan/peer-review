<?= $this->extend("layouts/base"); ?>
<?= $this->section("title"); ?>
Dashboard
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<!-- tinymce bof -->
<!-- api key -->
<!-- zl7gr0fd036d21vs0jyvf6mr7k4teplnzemg679ylz53ott5 -->

<!-- tinymce eof -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-24">Submission</h4>

        </div>
    </div>
</div>
<!-- end page title -->
<?= form_open_multipart(); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div id="basic-pills-wizard" class="twitter-bs-wizard">
                    <div class="twitter-bs-wizard-tab-content">
                        <div class="tab-pane" id="seller-details">
                            <div id="msg"></div>
                            <?php if (isset($validation)) : ?>
                                <div class="alert alert-danger">
                                    <?= $validation->listErrors(); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($success)) : ?>
                                <?php foreach ($success as $msg) : ?>
                                    <div class="alert alert-success">
                                        <?= $msg; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <h4 class="card-title font-size-14"><b>Submission Requirements</b></h4>
                            <h4 class="card-title font-size-13" style="margin-bottom:16px">You must read and acknowledge that you've completed the requirements below before proceeding.</h4>
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <label class="form-label  fw-normal" for="terms1">
                                            <input type="checkbox" class="custom-control-input" id="terms1" name="terms1"> <a href="#" class="text-muted2 ms-1">The submission has not been previously published, nor is it before another journal for consideration (or an explanation has been provided in Comments to the Editor). </a></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <label class="form-label  fw-normal" for="terms2">
                                            <input type="checkbox" class="custom-control-input" id="terms2" name="terms2"> <a href="#" class="text-muted2 ms-1">The submission file is in Microsoft Word document file format ONLY.</a></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <label class="form-label  fw-normal" for="terms3">
                                            <input type="checkbox" class="custom-control-input" id="terms3" name="terms3"> <a href="#" class="text-muted2 ms-1">Where available, URLS for the references have been provided.</a></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <label class="form-label  fw-normal" for="terms4">
                                            <input type="checkbox" class="custom-control-input" id="terms4" name="terms4"> <a href="#" class="text-muted2 ms-1">The text is single-spaced; uses a 12-point font; employs italics, rather than underlining (except with URL addresses); and all illustrations, figures, and tables files should be attached separately.</a></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <label class="form-label  fw-normal" for="terms5">
                                            <input type="checkbox" class="custom-control-input" id="terms5" name="terms5"> <a href="#" class="text-muted2 ms-1">The text adheres to the stylistic and bibliographic requirements outlined in the Author Guidelines.</a></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <h4 class="card-title font-size-14"><b>Comments for editor</b></h4>
                                <!-- tinemce -->
                                <tinymce-editor name="editor_comment" api-key="no-api-key" height="300" width="800" menubar="false" plugins="advlist autolink lists link image charmap preview anchor
                                searchreplace visualblocks code fullscreen
                                insertdatetime media table code help wordcount" toolbar=" undo redo | blocks | bold italic backcolor |
                                alignleft aligncenter alignright alignjustify | link image | print preview media fullscreen | 
                                bullist numlist outdent indent | removeformat | help" statusbar="false" content_style="body
                            {
                                font-family:Helvetica,Arial,sans-serif;
                                font-size:14px
                            }"><?= set_value('editor_comment'); ?></tinymce-editor>


                                <!-- tinymce -->
                            </div>
                            <h4 class="card-title font-size-14"><b>Corresponding Contact</b></h4>
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <label class="form-label  fw-normal" for="contact">
                                            <input type="checkbox" class="custom-control-input" id="contact" name="contact"> <a href="#" class="text-muted2 ms-1">Yes, I would like to be contacted about this submission.</a></label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <label class="form-label  fw-normal" for="data">
                                            <input type="checkbox" class="custom-control-input" id="data" name="data"> <a href="#" class="text-muted2 ms-1">Yes, I agree to have my data collected and stored according to the Policy statement.</a></label>
                                    </div>
                                </div>
                            </div>


                            <!-- <div>
                                <span id="coauthor" class="fw-bold"> </span>
                            </div> -->


                            <div class="row">
                                <div class="col-lg-8">
                                    <div>
                                        <button type="button" class="btn1 btn-primary waves-effect waves-light me-1" data-bs-toggle="modal" data-bs-target="#authorModal">
                                            UPLOAD FILE
                                        </button>
                                    </div>

                                    <div id="author-file"></div>
                                </div>
                            </div>
                            <!-- <div id="author-file"></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end page title -->


<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-24">Enter Metadata</h4>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- Spinner -->
                <div hidden id="spinner"></div>
                <div id="basic-pills-wizard" class="twitter-bs-wizard">
                    <div class="twitter-bs-wizard-tab-content">
                        <div class="tab-pane" id="seller-details">

                            <h4 class="card-title font-size-14"><b>Prefix</b></h4>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="prefix" name="prefix" value="<?= set_value('prefix'); ?>">
                                    </div>
                                </div>
                            </div>


                            <h4 class="card-title font-size-14"><b>Title*</b></h4>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="title" name="title" value="<?= set_value('title'); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title font-size-14"><b>Subtitle</b></h4>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?= set_value('subtitle'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <h4 class="card-title font-size-15"><b>Abstract*</b></h4>

                                <!-- tinemce abstract-->
                                <tinymce-editor name="abstract" api-key="no-api-key" height="300" width="800" menubar="false" plugins="advlist autolink lists link image charmap preview anchor
                                    searchreplace visualblocks code fullscreen
                                    insertdatetime media table code help wordcount" toolbar=" undo redo | blocks | bold italic backcolor |
                                    alignleft aligncenter alignright alignjustify | link image | print preview media fullscreen | 
                                    bullist numlist outdent indent | removeformat | help" statusbar="false" content_style="body 
                                {
                                    font-family:Helvetica,Arial,sans-serif;
                                    font-size:14px
                                    
                                }"></tinymce-editor>
                                <!-- tinymce -->

                            </div>

                            <!-- contributor list -->

                            <h4 class="card-title font-size-15"><b>List of Contributors</b></h4>
                            <div id="del"></div>
                            <div class="col-lg-8">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap font-size-13" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Primary Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td><?= session()->get('username'); ?></td>
                                            <td>
                                                <?= session()->get('logged_user'); ?>
                                            </td>
                                            <td>Author</td>
                                            <td><input class="" type="radio" checked disabled></td>
                                            <td></td>
                                        </tr>
                                        <!-- <?php if ($coAuthors) : ?>
                                            <?php foreach ($coAuthors as $coAuthor) : ?>
                                                <tr>
                                                    <td><?= $coAuthor->name; ?></td>
                                                    <td><?= $coAuthor->email; ?></td>
                                                    <td>Author</td>
                                                    <td><input class="check" type="radio" value="<?= $coAuthor->id; ?>" id="<?= $coAuthor->id; ?>" name="coauthor"></td>
                                                    <td> -->
                                        <!-- <button class="btn1 btn-danger"> <i class="fa fa-trash" onClick="del(<?= $coAuthor->id; ?>,'deleteCoauthor');" aria-hidden="true"></i></button> -->
                                        <!-- </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?> -->

                                    </tbody>
                                </table>
                                <div id="co-author"></div>

                            </div>
                            <?php //endif; 
                            ?>
                            <!-- eof contributor list -->






                            <div>

                                <div>

                                    <button type="button" class="btn1 btn-primary waves-effect waves-light me-1" data-bs-toggle="modal" data-bs-target="#contributorModal">
                                        Add contributor
                                    </button>
                                </div>


                                <span id="coauthor" class="fw-bold"> </span>
                            </div>

                            <br>
                            <h4 class="card-title font-size-1 font-size-14"><b>Language</b></h4>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="language" name="language" value="<?= set_value('language'); ?>">
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title font-size-14"><b>Keyword</b></h4>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="keyword" name="keyword" value="<?= set_value('keyword'); ?>">
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title font-size-14"><b>References</b></h4>
                            <!-- <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <textarea id="reference" name="reference" value="<?= set_value('reference'); ?>" class="form-control" rows="2"></textarea>
                                    </div>
                                </div>
                            </div> -->
                            <!-- tinemce reference-->
                            <tinymce-editor name="reference" api-key="no-api-key" height="300" width="800" menubar="false" plugins="advlist autolink lists link image charmap preview anchor
        searchreplace visualblocks code fullscreen
        insertdatetime media table code help wordcount" toolbar=" undo redo | blocks | bold italic backcolor |
        alignleft aligncenter alignright alignjustify | link image | print preview media fullscreen | 
        bullist numlist outdent indent | removeformat | help" statusbar="false" content_style="body
      {
        font-family:Helvetica,Arial,sans-serif;
        font-size:14px
      }"></tinymce-editor>
                            <!-- tinymce -->
                            <br>
                            <div class="mb-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Submit
                                    </button>
                                </div>
                            </div>
                            <br>



                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<?= form_close(); ?>

<!-- contributor Modal -->
<div class="modal fade" id="contributorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="contributorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="contributorModalLabel">Add contributor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="contributorForm" action="contributor" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <div class="input-group">

                            <input type="text" placeholder="First name" class="form-control" id="c-name" name="c-name" aria-describedby="first name" required>
                            <input type="text" placeholder="Middle name" class="form-control" name="m_name" id="m_name" aria-describedby="middle name">
                            <input type="text" placeholder="Last name" class="form-control" name="l_name" id="l_name" aria-describedby="last name">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="c-email" class="col-form-label">Email </label>
                        <input type="text" placeholder="Email" class="form-control" id="c-email" name="c-email" required>
                    </div>
                    <div class="mb-3">
                        <label for="c-country" class="col-form-label">Country </label>
                        <!-- <input type="text" class="form-control" id="c-country" name="c-country"> -->
                        <select class="form-select" aria-label="Country" id="c-country" name="c-country">
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antartica">Antarctica</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Congo">Congo, the Democratic Republic of the</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                            <option value="Croatia">Croatia (Hrvatska)</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="France Metropolitan">France, Metropolitan</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern Territories">French Southern Territories</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                            <option value="Holy See">Holy See (Vatican City State)</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India" selected>India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran (Islamic Republic of)</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Lao">Lao People's Democratic Republic</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macau">Macau</option>
                            <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia">Micronesia, Federated States of</option>
                            <option value="Moldova">Moldova, Republic of</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint LUCIA">Saint LUCIA</option>
                            <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia (Slovak Republic)</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                            <option value="Span">Spain</option>
                            <option value="SriLanka">Sri Lanka</option>
                            <option value="St. Helena">St. Helena</option>
                            <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syrian Arab Republic</option>
                            <option value="Taiwan">Taiwan, Province of China</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania, United Republic of</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks and Caicos">Turks and Caicos Islands</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Viet Nam</option>
                            <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                            <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                            <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="userdetails" class="form-label">User details</label>
                        <div class="input-group">

                            <input type="text" placeholder="Suffix" class="form-control" id="suffix" name="suffix" aria-describedby="user details">
                            <input type="text" placeholder="Url" class="form-control" name="url" id="url" aria-describedby="user details">
                            <input type="text" placeholder="ORCID" class="form-control" name="orcid" id="orcid" aria-describedby="user details">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="affiliation" class="col-form-label">Affiliation </label>
                        <input type="text" placeholder="Affiliation" class="form-control" id="affiliation" name="affiliation">
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">Bio Statements</span>
                        <textarea class="form-control" aria-label="Statements" id="bio_statement" name="bio_statement" rows="3"></textarea>
                    </div>
                    <p></p>
                    <label for="contributor" class="form-label">Contributor's role* </label>

                    <!-- <div class="form-group input-group  ">

                        <input class=" checkmark" type="radio" id="c-roleID" name="c-roleID" value="3">
                        <label for="c-author">&nbsp; Author</label><br>
                    </div>

                    <div class="form-group input-group ">

                        <input class=" checkmark" type="radio" id="c-roleID" name="c-roleID" value="5">
                        <label for="translator">&nbsp; Translator</label><br>
                    </div> -->

                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="c-roleID" name="c-roleID" value="3">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Author
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="cc-roleID" name="c-roleID" value="5">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Translator
                        </label>
                    </div>


                    <p></p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="contact" name="contact">
                        <label class="form-check-label" for="contact">
                            Principal contact for editorial correspondence.
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="browse_list" name="browse_list" checked>
                        <label class="form-check-label" for="browse_list">
                            Include this contributor in browse list?
                        </label>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--    contributor eof modal-->


<!-- author file upload Modal -->
<div class="modal fade" id="authorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="authorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="authorModalLabel">File upload</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="authorForm" action="authorTempUpload" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="c-country" class="col-form-label">Article component </label>

                        <select class="form-select" name="article_type" id="article_type">
                            <option>Select article component</option>
                            <option value="Article Text">Article Text</option>
                            <option value="Reasearch Instrument">Research Instrument</option>
                            <option value="Research Materials">Research Materials</option>
                            <option value="Research Results">Research Results</option>
                            <option value="Transcripts">Transcripts</option>
                            <option value="Data Analysis">Data Analysis</option>
                            <option value="Data Set">Data set</option>
                            <option value="Source Texts">Source Texts</option>
                            <option value="Other">Other</option>
                        </select>

                    </div>
                    <div class="mb-3">

                        <input type="file" name="articlefile" id="articlefile" class="fileToUpload">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--    author file upload eof modal-->



<?= $this->section('javascript'); ?>
<script type="text/javascript" src="<?= base_url(); ?>js/submission.js"></script>

<?= $this->endSection(); ?>

<?= $this->endSection(); ?>