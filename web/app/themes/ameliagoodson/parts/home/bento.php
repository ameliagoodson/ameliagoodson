<?php
$works = get_posts(array(
  "post_type" => "work",
  "posts_per_page" => 6, // Fetch all posts
  "orderby" => "menu_order",
));

$default_work_link = '/work'; // Default link to the /work page
$work_text = get_field('work_text');
?>

<section id="work">
  <div class="section-inner mw-large">
    <div class="section-intro">
      <h2 class="section-title">Work</h2>
      <?php
      if ($work_text) : ?>
        <p class="reveal"><?php echo $work_text ?></p>
      <?php endif ?>
    </div>
    <div class="grid bento-grid">
      <?php foreach ($works as $index => $work) : ?>
        <?php
        // Fetch the group field
        $work_group = get_field('work', $work->ID); // Fetch the "work" group

        // Check if the group field has data
        if ($work_group) {
          $work_title = $work_group['work_title'] ?: ''; // Access subfields
          $work_subtitle = $work_group['work_subtitle'] ?: '';
          $work_description = get_the_excerpt($work->ID);
          $work_image = get_the_post_thumbnail($work->ID, 'full');
          $work_video = $work_group['work_video'] ?: [];
          $work_link = $work_group['work_link'] ?: $default_work_link;
          $work_button = $work_group['work_button'] ?: false;
        }
        ?>
        <?php if (!empty(array_filter($works))) : ?>
          <div class="grid-item bento-card grid-item0<?= $index + 1 ?> reveal">
            <div class="bento-details">
              <?php if ($work_title) : ?>
                <a class="bento-link" href="<?php echo esc_url($work_link) ?>">
                  <h3 class="bento-title"><?php echo $work_title ?></h3>
                </a>
              <?php endif ?>
              <?php if ($work_subtitle) : ?>
                <p class="bento-subtitle"><?php echo $work_subtitle ?></p>
              <? endif ?>
              <?php
              if ($work_description) : ?>
                <p class="bento-description"><?php echo $work_description ?></p>
              <?php endif ?>
              <?php
              if ($work_button) : ?>
                <div class="btn-container">
                  <a class="btn bento-button" href="<?php echo esc_url($work_link) ?>">See More</a>
                </div>
              <?php endif ?>
            </div>
            <div class="bento-image">
              <?php if ($work_video) : ?>
                <video controls poster>
                  <source src="" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              <?php else : ?>
                <a href="<?php echo $work_link ?>">
                  <?php echo $work_image; ?>
                </a>
                <?php ?>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>


      <?php endforeach; ?>
    </div>
  </div>
</section>