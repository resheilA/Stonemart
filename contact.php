<?php include("header.php"); ?>

<!-- Map Section Begin -->
<div class="map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24112.92132811736!2d-74.20651812810036!3d40.93514309648714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2fda38587e887%3A0xf03207815e338a0d!2sHaledon%2C%20NJ%2007508%2C%20USA!5e0!3m2!1sen!2sbd!4v1578120776078!5m2!1sen!2sbd"
        height="612" style="border:0;" allowfullscreen=""></iframe>
    <img src="img/icon/location.png" alt="">
</div>
<!-- Map Section End -->

<!-- Contact Section Begin -->
<div class="contact_info">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">
                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="https://img.icons8.com/office/24/000000/iphone.png" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Phone</div>
                            <div class="contact_info_text">+91 9876 543 2198</div>
                        </div>
                    </div> <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="https://img.icons8.com/ultraviolet/24/000000/filled-message.png" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Email</div>
                            <div class="contact_info_text">contact@bbbootstrap.com</div>
                        </div>
                    </div> <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="https://img.icons8.com/ultraviolet/24/000000/map-marker.png" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Address</div>
                            <div class="contact_info_text">298,Menlo Park,CA,USA</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Contact Form -->
<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_form_container">
                    <div class="contact_form_title">Get in Touch</div>
                    <form action="#" id="contact_form">
                        <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between"> <input type="text" id="contact_form_name" class="contact_form_name input_field" placeholder="Your name" required="required" data-error="Name is required."> <input type="text" id="contact_form_email" class="contact_form_email input_field" placeholder="Your email" required="required" data-error="Email is required."> <input type="text" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Your phone number"> </div>
                        <div class="contact_form_text"> <textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Message" required="required" data-error="Please, write us a message."></textarea> </div>
                        <div class="contact_form_button"> <button type="submit" class="button contact_submit_button">Send Message</button> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <br><br>

 <?php include("footer.php"); ?>