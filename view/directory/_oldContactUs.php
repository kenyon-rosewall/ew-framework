<div id="contactus">
   
  <form>
      <div class="form-group">
         <label class="sr-only" for="contact_us_name">Full Name</label>
         <input type="text" class="form-control" id="contact_us_name" name="contact_us[name]" placeholder="Full Name (Required)">
      </div>
      <div class="form-group">
         <label class="sr-only" for="contact_us_email">Email Address</label>
         <input type="text" class="form-control" id="contact_us_email" name="contact_us[email]" placeholder="Email Address (Required)">
      </div>
      <div class="form-group">
         <label class="sr-only" for="contact_us_phone">Phone Number</label>
         <input type="text" class="form-control" id="contact_us_phone" name="contact_us[phone]" placeholder="Phone Number">
      </div>
      <div class="form-group">
         <label class="sr-only" for="contact_us_contactustype_id">Subject</label>
         <select class="form-control" id="contact_us_contactustype_id" name="contact_us[contactustype_id]">
            <option value="4">Page Approved - Please Put my Page Online</option>
            <option value="5">Page Pending - I Want Changes (Listed Below)</option>
         </select>
      </div>
      <div class="form-group">
         <label class="sr-only" for="contact_us_message">Message</label>
         <textarea class="form-control" id="contact_us_message" name="contact_us[message]" rows="3"></textarea>
      </div>
      <?php //echo $contactForm->renderHiddenFields() ?>
      <button type="submit" class="btn btn-warning" name="Contact">Submit</button>
   </form>
   
</div>