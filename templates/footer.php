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
  <li><a href="/meine-daten" title="meine daten">Meine Daten</a></li>
  <li><a id="ct-ultimate-gdpr-cookie-open" title="Cookie einstellungen">Cookie einstellungen</a></li>
 </ul>
</div>

<p id="back-top">
	<a href="#top"><span><i class="fa fa-arrow-up"></i></span></a>
</p>


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
