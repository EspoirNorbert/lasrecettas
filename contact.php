<?php
$titlePage = "Contactez Nous";
require_once('inc/header.php'); ?>
<h3 class="mt-3 fw-bolder">Contactez nous</h3>
<hr>
<form action="submit_contact.php" method="POST">
    <div class="mb-3">
        <label for="email" class="form-label">Nom</label>
        <input type="email" class="form-control" id="email" name="nom" required placeholder="John Doe">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required placeholder="johndoe@gmail.com">
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" placeholder="Exprimez vous" id="message" col="10" rows="10" name="message"></textarea>
    </div>
    <button type="submit" class="btn btn-dark">Envoyer le message</button>
</form>
</div>
<?php
require_once('inc/footer.php');
