<footer class="content-info">
  <div class="container">
    <div class="row">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    </div>
  </div>
</footer>
<div class="footer-copyright">
 <ul>
  <li>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></li>
  <li><a href="/impressum" title="Impressum">Impressum</a></li>
  <li><a href="/datenschutz" title="Datenschutz">Datenschutz</a></li>
  <li><a href="/cookies" title="Cookies">Cookies</a></li>
  <!-- <li><a href="/allgemeine-geschaeftsbedingungen" title="allgemeine geschäftsbedingungen">AGB</a></li> --->
  <!-- <li><a href="/meine-daten" title="meine daten">Meine Daten</a></li> -->
  <!-- <li><a id="ct-ultimate-gdpr-cookie-open" title="Cookie einstellungen">Cookie einstellungen</a></li> -->
 </ul>
</div>

<p id="back-top">
	<a href="#top" aria-label="Nach oben scrollen Button"><span><i class="fa fa-arrow-up"></i></span></a>
</p>

<div class="overlay"></div>
<!-- Start contact Modal -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="myModal" class="modal fade testclass">
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

<!-- Lozad.js -->
<script defer type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad"></script>
<!--tiny slider-->
<script defer type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/min/tiny-slider.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
<!--[if (lt IE 9)]><script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/min/tiny-slider.helper.ie8.js"></script><![endif]-->
<script defer type="text/javascript" src="https://d2o0x3khes243j.cloudfront.net/b20ad1bea8_fonta.js"></script>
