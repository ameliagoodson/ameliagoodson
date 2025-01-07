<?php
$about_text   = get_field('about_text');
$about_image  = get_field('about_image');

?>

<section id="about">
  <div class="section-inner mw-medium">
    <h2 class="section-title">About</h2>
    <div class="container">
      <div class="col-l-8 col">
        <?php echo $about_text ?>
      </div>
      <div class="col-l-4 col">
        <img src="<?php echo $about_image['url'] ?>" alt="">
      </div>
    </div>
  </div>
</section>