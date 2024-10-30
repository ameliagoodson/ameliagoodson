<?php
$work1 = get_field('work_group_1');
$work2 = get_field('work_group_2');
$work3 = get_field('work_group_3');
$work4 = get_field('work_group_4');
$work5 = get_field('work_group_5');
$work6 = get_field('work_group_6');

$default_work_link = '/work'; // Default link to the /work page
?>
<section id="work">
  <div class="section-inner mw-medium">
    <div class="section-intro">
      <h2 class="section-title">Work</h2>
      <p class="reveal">Here are some of the projects I've worked on.</p>
    </div>
    <div class="grid bento-grid">
      <?php foreach ([$work1, $work2, $work3, $work4, $work5, $work6] as $index => $work) : ?>
        <?php if (!empty(array_filter($work))) : ?>
          <div class="grid-item bento-card grid-item0<?= $index + 1 ?> reveal">
            <div class="bento-card-description">
              <?php
              $work_link = !empty($work['work_link']) ? esc_url($work['work_link']) : esc_url($default_work_link);
              echo $work['work_title'] ? '<a class="bento-link" href="' . $work_link . '"><h3 class="bento-title">' . $work['work_title'] . '</h3></a>' : '';
              ?>
              <?php echo $work['work_subtitle'] ? '<p>' . $work['work_subtitle'] . '</p>' : '' ?>
              <?php echo $work['work_button'] != false ? '<a class="btn btn-sm" href="' . $work_link . '">See More</a>' : '' ?>
            </div>
            <div class="bento-card-details">
              <?php if (!empty($work['work_video'])) : ?>
                <video controls poster="<?php echo esc_url($work['work_image']['url']); ?>">
                  <source src="<?php echo esc_url($work['work_video']['url']); ?>" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              <?php else : ?>
                <?php echo isset($work['work_image']['url']) ? '<img src="' . esc_url($work['work_image']['url']) . '">' : '' ?>
                <?php echo isset($work['work_image_2']['url']) ? '<img src="' . esc_url($work['work_image_2']['url']) . '">' : '' ?>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>