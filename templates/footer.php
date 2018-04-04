<footer class="content-info">
  <div class="container">
    <div class="row">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    </div>
  </div>
</footer>
<div class="footer-copyright">
	<div class="container">
  &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> - <a href="/impressum" title="impressum">Impressum</a> - <a href="/datenschutz" title="Datenschutz">Datenschutz</a> - <a href="/agb" title="allgemeine geschäftsbedingungen">AGB</a>
	</div>
</div>

<p id="back-top">
	<a href="#top"><span><i class="fa fa-arrow-up"></i></span></a>
</p>


<!-- Start contact Modal -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        <button aria-hidden="true" data-dismiss="modal" class="close contact-form-close" type="button">x</button>
            <div class="modal-body">
            Sie haben Fragen oder wünschen weitere Informationen?
            Dann schreiben Sie uns. Wir helfen Ihnen gerne weiter. Bitte füllen Sie einfach das Kontaktformular aus und senden Sie uns Ihre Nachricht.
            <div class="container-contact-form">
            <div class="row-contact-form">
            <div class="contact-form"><?php $options = get_option('futurewave_theme_options'); echo do_shortcode(''.$options['headercontact'].''); ?></div>
            </div>
            </div>
          </div><!-- /.modal-body -->
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div><!-- End modal -->



<!-- Start Newsletter Modal -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="myModal2" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <button aria-hidden="true" data-dismiss="modal" class="close newsletter-form-close" type="button">x</button>
          <div class="modal-body">
        		<div class="contact-form">
              <!-- Begin MailChimp Signup Form -->
              <div id="mc_embed_signup">
                <form action="//dichtungen-knowhow.us4.list-manage.com/subscribe/post?u=dc33750d705aedfe96f08bddd&amp;id=27384879d3" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                  <div id="mc_embed_signup_scroll">
              	<h2>SKF Newsletter-Anmeldung</h2>
              <div class="indicates-required"><span class="asterisk">*</span> Pflichtfelder</div>
              <div class="mc-field-group">
              	<label for="mce-EMAIL">Ihre Email-Adresse  <span class="asterisk">*</span>
              </label>
              	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
              </div>

              <div class="mc-field-group">
              	<label for="mce-MMERGE3">Anrede </label>
              	<select name="MMERGE3" class="" id="mce-MMERGE3">
              	<option value=""></option>
              	<option value="Herr">Herr</option>
              <option value="Frau">Frau</option>

              	</select>
              </div>

              <div class="mc-field-group">
              	<label for="mce-FNAME">Vorname </label>
              	<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
              </div>
              <div class="mc-field-group">
              	<label for="mce-LNAME">Nachname </label>
              	<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
              </div>
              <div class="mc-field-group">
              	<label for="mce-MMERGE4">Firma </label>
              	<input type="text" value="" name="MMERGE4" class="" id="mce-MMERGE4">
              </div>
              <div class="mc-field-group" style="display:none;">
              	<label for="mce-MMERGE5">Website </label>
              	<input type="text" value="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" name="MMERGE5" class="" id="mce-MMERGE5">
              </div>
              <div class="mc-field-group input-group">
                  <strong>Bitte wählen Sie ihren Interessensbereich </strong>
                  <ul>
              <li><input type="checkbox" value="2" name="group[16417][2]" id="mce-group[16417]-16417-1"><label for="mce-group[16417]-16417-1">Lebensmittelindustrie</label></li>
              <li><input type="checkbox" value="4" name="group[16417][4]" id="mce-group[16417]-16417-2"><label for="mce-group[16417]-16417-2">Hydraulik und Pneumatik</label></li>
              <li><input type="checkbox" value="8" name="group[16417][8]" id="mce-group[16417]-16417-3"><label for="mce-group[16417]-16417-3">Metallverarbeitung und Rohstoffgewinnung</label></li>
              <li><input type="checkbox" value="16" name="group[16417][16]" id="mce-group[16417]-16417-4"><label for="mce-group[16417]-16417-4">Anlagenbau</label></li>
              <li><input type="checkbox" value="32" name="group[16417][32]" id="mce-group[16417]-16417-5"><label for="mce-group[16417]-16417-5">Prozesstechnik</label></li>
              <li><input type="checkbox" value="64" name="group[16417][64]" id="mce-group[16417]-16417-6"><label for="mce-group[16417]-16417-6">Werkzeugmaschinen, Pressen, Automotiv</label></li>
              </ul>
              </div>
              	<div id="mce-responses" class="clear">
              		<div class="response" id="mce-error-response" style="display:none"></div>
              		<div class="response" id="mce-success-response" style="display:none"></div>
              	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                  <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_dc33750d705aedfe96f08bddd_33cb7c8305" tabindex="-1" value=""></div>
                  <div class="clear"><input type="submit" value="Anmelden" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                  </div>
                  <div class="footer-copyright">
        	          <div>Die erteilte Einwilligung zur Speicherung der Daten, der E-Mail-Adresse sowie deren Nutzung zum Versand des Newsletters können Sie jederzeit widerrufen.  -
        	          <a href="/datenschutz/">Datenschutz</a></div>
        	       </div>
              </form>
              </div>
              <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
              <script type='text/javascript'>
              (function($) {
                window.fnames = new Array();
                window.ftypes = new Array();
                fnames[0]='EMAIL';
                ftypes[0]='email';
                fnames[3]='MMERGE3';
                ftypes[3]='text';
                fnames[1]='FNAME';
                ftypes[1]='text';
                fnames[2]='LNAME';
                ftypes[2]='text';
                fnames[4]='MMERGE4';
                ftypes[4]='text'; /*
               * Translated default messages for the $ validation plugin.
               * Locale: DE
               */
              $.extend($.validator.messages, {
              	required: "Dieses Feld ist ein Pflichtfeld.",
              	maxlength: $.validator.format("Geben Sie bitte maximal {0} Zeichen ein."),
              	minlength: $.validator.format("Geben Sie bitte mindestens {0} Zeichen ein."),
              	rangelength: $.validator.format("Geben Sie bitte mindestens {0} und maximal {1} Zeichen ein."),
              	email: "Geben Sie bitte eine gültige E-Mail Adresse ein.",
              	url: "Geben Sie bitte eine gültige URL ein.",
              	date: "Bitte geben Sie ein gültiges Datum ein.",
              	number: "Geben Sie bitte eine Nummer ein.",
              	digits: "Geben Sie bitte nur Ziffern ein.",
              	equalTo: "Bitte denselben Wert wiederholen.",
              	range: $.validator.format("Geben Sie bitten einen Wert zwischen {0} und {1}."),
              	max: $.validator.format("Geben Sie bitte einen Wert kleiner oder gleich {0} ein."),
              	min: $.validator.format("Geben Sie bitte einen Wert größer oder gleich {0} ein."),
              	creditcard: "Geben Sie bitte ein gültige Kreditkarten-Nummer ein."
              });}(jQuery));var $mcj = jQuery.noConflict(true);</script>
              <!--End mc_embed_signup-->
              <!--End mc_embed_signup-->
      </div>
	   </div>
    </div>
  </div> <!-- /.modal-dialog -->
</div><!-- / End modal -->
