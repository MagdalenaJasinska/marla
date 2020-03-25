<div class="main-box-content">
	<span class="profile-knows">Please know all information is confidential and used for the sole purpose of facilitating your own healing process</span>
	<form method="post" class="personal-profile-sec">
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-left-sec">
				<div class="adv-label-sec"><label>Name</label></div>
				<div class="adv-content-sec"><input type="text" name="uname" value="<?php echo $user_metadata->profile_name;?>"></div>
			</div>
			<div class="upbox-right-sec">
				<div class="adv-label-sec"><label>Home Phone</label></div>
				<div class="adv-content-sec"><input type="text" name="uhphone" value="<?php echo $user_metadata->profile_phone;?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-left-sec">
				<div class="adv-label-sec"><label>Address</label></div>
				<div class="adv-content-sec"><input type="text" name="uaddress" value="<?php echo $user_metadata->profile_address;?>"></div>
			</div>
			<div class="upbox-right-sec">
				<div class="adv-label-sec"><label>Cell Phone</label></div>
				<div class="adv-content-sec"><input type="text" name="ucphone" value="<?php echo $user_metadata->profile_cellphone;?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-first-sec">
				<div class="adv-label-sec"><label>City</label></div>
				<div class="adv-content-sec"><input type="text" name="ucity" value="<?php echo $user_metadata->profile_city;?>"></div>
			</div>
			<div class="upbox-second-sec">
				<div class="adv-label-sec"><label>State</label></div>
				<div class="adv-content-sec"><input type="text" name="ustate" value="<?php echo $user_metadata->profile_state;?>"></div>
			</div>
			<div class="upbox-third-sec">
				<div class="adv-label-sec"><label>Zip Code</label></div>
				<div class="adv-content-sec"><input type="text" name="uzipcode" value="<?php echo $user_metadata->profile_zipcode;?>"></div>
			</div>
			<div class="upbox-fourth-sec">
				<div class="adv-label-sec"><label>Email</label></div>
				<div class="adv-content-sec"><input type="text" name="uemail" value="<?php echo $user_data->user_email;?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-40-sec">
				<div class="adv-label-sec"><label>Date of Birth</label></div>
				<?php $profile_date_of_birth = $user_metadata->profile_date_of_birth;?>
				<div class="adv-content-sec adv-content-78-sec"><input type="text" name="udate_of_birth" class="advent-dates" value="<?php echo !(empty($profile_date_of_birth))?date('d F, Y', strtotime($user_metadata->profile_date_of_birth)):'';?>"></div>
			</div>
			<div class="upbox-20-sec">
				<div class="adv-label-sec"><label>Age</label></div>
				<div class="adv-content-sec adv-content-80-sec"><input type="text" name="uage" value="<?php echo $user_metadata->profile_age;?>"></div>
			</div>
			<div class="upbox-40-sec">
				<div class="adv-label-sec"><label>Marital Status</label></div>
				<div class="adv-content-sec adv-content-75-sec"><input type="text" name="umarital_status" value="<?php echo $user_metadata->profile_marital_status;?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-60-sec">
				<div class="adv-label-sec"><label>Have you previously experienced energy healing?</label></div>
				<div class="adv-content-sec adv-content-56-sec"><input type="text" name="uis_previously_experienced_healing" value="<?php echo $user_metadata->profile_marital_is_previously_experienced_healing;?>"></div>
			</div>
			<div class="upbox-40-sec">
				<div class="adv-label-sec"><label>With whom ?</label></div>
				<div class="adv-content-sec adv-content-75-sec"><input type="text" name="uwith_whom" value="<?php echo $user_metadata->with_whom;?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-100-sec">
				<div class="adv-label-sec"><label>Present physician and/or health practitioner</label></div>
				<div class="adv-content-sec adv-content-70-sec"><input type="text" name="upresent_physician_health" value="<?php echo $user_metadata->profile_present_physician_health;?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-100-sec">
				<div class="adv-label-sec"><label>Please list all medication, drugs and vitamins you are taking</label></div>
				<div class="adv-content-sec adv-content-58-sec"><input type="text" name="u_list_medication_drugs[]" value="<?php echo $user_metadata->profile_list_medication_drugs[0];?>"></div>
				<div class="adv-content-sec adv-content-100-sec"><input type="text" name="u_list_medication_drugs[]" value="<?php echo $user_metadata->profile_list_medication_drugs[1];?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-100-sec">
				<div class="adv-label-sec"><label>Please list all previous major illnesses, surgeries, hospitalizations and injuries and year of occurance</label></div>
				<div class="adv-content-sec adv-content-33-sec"><input type="text" name="u_list_illnesses_surgeries[]" value="<?php echo $user_metadata->profile_list_illnesses_surgeries[0];?>"></div>
				<div class="adv-content-sec adv-content-100-sec"><input type="text" name="u_list_illnesses_surgeries[]" value="<?php echo $user_metadata->profile_list_illnesses_surgeries[1];?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-100-sec">
				<div class="adv-label-sec"><label>Are there any residual effects?</label></div>
				<div class="adv-content-sec adv-content-78-sec"><input type="text" name="u_is_any_residual_effects" value="<?php echo $user_metadata->profile_is_any_residual_effects;?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-100-sec">
				<div class="adv-label-sec"><label>What specific problems are you here to work on?</label></div>
				<div class="adv-content-sec adv-content-65-sec"><input type="text" name="u_specific_problems[]" value="<?php echo $user_metadata->profile_specific_problems[0];?>"></div>
				<div class="adv-content-sec adv-content-100-sec"><input type="text" name="u_specific_problems[]" value="<?php echo $user_metadata->profile_specific_problems[1];?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-100-sec">
				<div class="adv-label-sec"><label>What are your goals or expectations of this work?</label></div>
				<div class="adv-content-sec adv-content-65-sec"><input type="text" name="u_goals_expectations[]" value="<?php echo $user_metadata->profile_goals_expectations[0];?>"></div>
				<div class="adv-content-sec adv-content-100-sec"><input type="text" name="u_goals_expectations[]" value="<?php echo $user_metadata->profile_goals_expectations[1];?>"></div>
				<div class="adv-content-sec adv-content-100-sec"><input type="text" name="u_goals_expectations[]" value="<?php echo $user_metadata->profile_goals_expectations[2];?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<?php 
				$is_light_stress = ($user_metadata->profile_living_under_stress == 'Light')?'checked':'';
				$is_moderate_stress = ($user_metadata->profile_living_under_stress == 'Moderate')?'checked':'';
				$is_heavy_stress = ($user_metadata->profile_living_under_stress == 'Heavy')?'checked':'';
			?>
			<div class="upbox-50-sec">
				<div class="adv-label-sec"><label>Are You Living Under Stress?  Light</label></div>
				<div class="adv-content-sec adv-content-30-sec"><input type="checkbox" name="u_living_under_stress" class="adv-um-15" value="Light" <?php echo $is_light_stress;?>></div>
			</div>
			<div class="upbox-25-sec">
				<div class="adv-label-sec"><label>Moderate</label></div>
				<div class="adv-content-sec adv-content-30-sec"><input type="checkbox" name="u_living_under_stress" class="adv-um-15" value="Moderate" <?php echo $is_moderate_stress;?>></div>
			</div>
			<div class="upbox-25-sec">
				<div class="adv-label-sec"><label>Heavy</label></div>
				<div class="adv-content-sec adv-content-30-sec"><input type="checkbox" name="u_living_under_stress" class="adv-um-15" value="Heavy" <?php echo $is_heavy_stress;?>></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-25-sec">
				<div class="adv-label-sec"><label>Do you Exercise?</label></div>
				<div class="adv-content-sec adv-content-50-sec"><input type="text" name="u_do_you_exercise" value="<?php echo $user_metadata->profile_do_you_exercise;?>"></div>
			</div>
			<div class="upbox-25-sec">
				<div class="adv-label-sec"><label>How often? </label></div>
				<div class="adv-content-sec adv-content-60-sec"><input type="text" name="u_how_often" value="<?php echo $user_metadata->profile_how_often;?>"></div>
			</div>
			<div class="upbox-25-sec">
				<div class="adv-label-sec"><label>Do you smoke? </label></div>
				<div class="adv-content-sec adv-content-smoke-sec"><input type="text" name="u_do_you_smoke" value="<?php echo $user_metadata->profile_do_you_smoke;?>"></div>
			</div>
			<div class="upbox-25-sec">
				<div class="adv-label-sec"><label>How much?</label></div>
				<div class="adv-content-sec adv-content-65-sec"><input type="text" name="u_how_much" value="<?php echo $user_metadata->profile_how_much;?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-40-sec">
				<div class="adv-label-sec"><label>Do you meditate? </label></div>
				<div class="adv-content-sec adv-content-65-sec"><input type="text" name="u_do_you_meditate" value="<?php echo $user_metadata->profile_do_you_meditate;?>"></div>
			</div>
			<div class="upbox-60-sec">
				<div class="adv-label-sec"><label>/or do any other on-going spiritual practice? </label></div>
				<div class="adv-content-sec adv-content-sec-3"><input type="text" name="u_spiritual_practice" value="<?php echo $user_metadata->spiritual_practice;?>"></div>
			</div>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mt-80 adv-mb-15">
			<center class="adv-mb-15"><strong>Statement of Acknowledgement</strong></center>
			<p class="adv-statement">I understand <span class="adv-text-format">laying on of hands</span> sessions are a cooperative process intended to assist in my physical, emotional and spiritual well being.  It does not replace medical healthcare, diagnosis or treatment. <span class="adv-text-format">Laying on of hands</span> works in cooperation with it. I understand that no medical claim is made as to the effect or outcome of this healing service and I have sought out this service of my own free will</p>
		</div>
		<div class="adv-col-12 adv-pl-no adv-pr-no adv-mb-15">
			<div class="upbox-40-sec">
				<?php $profile_sign_date = $user_metadata->profile_sign_date;?>
				<div class="adv-label-sec"><label>Date</label></div>
				<div class="adv-content-sec adv-content-70-sec"><input type="text" name="u_date" class="advent-dates" value="<?php echo !empty($profile_sign_date)?date('d F, Y', strtotime($profile_sign_date)):'';?>"></div>
			</div>
			<div class="upbox-60-sec">
				<div class="adv-label-sec"><label>Signature </label></div>
				<div class="adv-content-sec adv-content-40-sec"><input type="text" name="u_signature" value="<?php echo $user_metadata->profile_signature;?>"></div>
			</div>
		</div>

		<input type="hidden" name="personal_update_nonce" value="<?php echo wp_create_nonce('personal-update-nonce'); ?>"/>
		<?php if(!array_key_exists('id', $_GET)){ ?>
			<input type="submit" name="update-personal-profile" class="adv-btn" value="<?php _e('Save'); ?>"/>
		<?php } ?>
	</form>
</div>