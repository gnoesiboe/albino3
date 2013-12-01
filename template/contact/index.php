<section>
  <h1 class="title-first">Contact</h1>
  <p>
    Wanneer je voor de eerste keer bij Lijflied komt bespreken we je wensen en de mogelijkheden. <strong>Deze kennismaking is gratis</strong>.
  </p>
  <p>
    Wil je meer informatie of jezelf direct aanmelden, vul dan onderstaand contactformulier in:
  </p>

  <?php if ($this->get('success') !== true): ?>
  <?php $input = $this->get('input'); ?>
  <?php $errors = $this->get('errors'); ?>
  <form action="#form" id="form" method="POST" class="form">
    <div>
      <div class="input-wrapper<?php echo isset($errors['name']) === true ? ' is-error': ''; ?>">
        <label for="input-name">Naam:</label>
        <input name="contact[name]" class="input" id="input-name" type="text" value="<?php echo isset($input['name']) === true ? $input['name'] : ''; ?>" />

        <?php if (isset($errors['name']) === true): ?>
        <ul class="list error">
          <li><?php echo $errors['name']; ?></li>
        </ul>
        <?php endif; ?>
      </div>

      <div class="input-wrapper<?php echo isset($errors['email']) === true ? ' is-error': ''; ?>">
        <label for="input-email">E-mailadres:</label>
        <input name="contact[email]" class="input" id="input-email" type="text" value="<?php echo isset($input['email']) === true ? $input['email'] : ''; ?>" />

        <?php if (isset($errors['email']) === true): ?>
        <ul class="list error">
          <li><?php echo $errors['email']; ?></li>
        </ul>
        <?php endif; ?>
      </div>

      <div class="input-wrapper<?php echo isset($errors['message']) === true ? ' is-error': ''; ?>">
        <label for="input-message">Aanmelden/vraag:</label>
        <textarea id="input-message" class="input" rows="5" name="contact[message]"><?php echo isset($input['message']) === true ? $input['message'] : ''; ?></textarea>

        <?php if (isset($errors['message']) === true): ?>
        <ul class="list error">
          <li><?php echo $errors['message']; ?></li>
        </ul>
        <?php endif; ?>
      </div>

      <input type="submit" value="versturen" />
    </div>
    <?php else: ?>
    <div class="message-success">
      Je boodschap is verstuurd. Ik neem zo snel mogelijk contact met je op!
    </div>
    <?php endif; ?>
  </form>

  <p class="highlight spacer bottom-3">Bellen kan natuurlijk ook: 06 54950166</p>
  <p>
    Christel van der Bruggen<br />
    Koudepad 3<br />
    5051RM Goirle<br />

    kvk-nummer:58338810
  </p>
</section>