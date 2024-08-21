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
      <h2>Work</h2>
      <p>Here are some of the projects I've worked on.</p>
    </div>
    <div class="grid bento-grid">
      <?php if (!empty(array_filter($work1))) : ?>
        <div class="grid-item bento-card grid-item01">
          <div class="bento-card-description">
            <?php
            $work1_link = !empty($work1['work_link']) ? esc_url($work1['work_link']) : esc_url($default_work_link);
            echo $work1['work_title'] ? '<a class="bento-link" href="' . $work1_link . '"><h3 class="bento-title">' . $work1['work_title'] . '</h3></a>' : '';
            ?>
            <?php echo $work1['work_subtitle'] ? '<p>' . $work1['work_subtitle'] . '</p>' : '' ?>
          </div>
          <div class="bento-card-details">
            <?php echo isset($work1['work_image']['url']) ? '<img src="' . esc_url($work1['work_image']['url']) . '">' : '' ?>
          </div>
        </div>
      <?php endif ?>

      <?php if (!empty(array_filter($work2))) : ?>
        <div class="grid-item bento-card grid-item02">
          <div class="bento-card-description">
            <?php
            $work2_link = !empty($work2['work_link']) ? esc_url($work2['work_link']) : esc_url($default_work_link);
            echo $work2['work_title'] ? '<a class="bento-link" href="' . $work2_link . '"><h3 class="bento-title">' . $work2['work_title'] . '</h3></a>' : '';
            ?>
            <?php echo $work2['work_subtitle'] ? '<p>' . $work2['work_subtitle'] . '</p>' : '' ?>
          </div>
          <div class="bento-card-details">
            <?php echo isset($work2['work_image']['url']) ? '<img src="' . esc_url($work2['work_image']['url']) . '">' : '' ?>
          </div>
        </div>
      <?php endif ?>

      <?php if (!empty(array_filter($work3))) : ?>
        <div class="grid-item bento-card grid-item03">
          <div class="bento-card-description">
            <?php
            $work3_link = !empty($work3['work_link']) ? esc_url($work3['work_link']) : esc_url($default_work_link);
            echo $work3['work_title'] ? '<a class="bento-link" href="' . $work3_link . '"><h3 class="bento-title">' . $work3['work_title'] . '</h3></a>' : '';
            ?>
            <?php echo $work3['work_subtitle'] ? '<p>' . $work3['work_subtitle'] . '</p>' : '' ?>
          </div>
          <div class="bento-card-details">
            <?php echo isset($work3['work_image']['url']) ? '<img src="' . esc_url($work3['work_image']['url']) . '">' : '' ?>
          </div>
        </div>
      <?php endif ?>

      <?php if (!empty(array_filter($work4))) : ?>
        <div class="grid-item bento-card grid-item04">
          <div class="bento-card-description">
            <?php
            $work4_link = !empty($work4['work_link']) ? esc_url($work4['work_link']) : esc_url($default_work_link);
            echo $work4['work_title'] ? '<a class="bento-link" href="' . $work4_link . '"><h3 class="bento-title">' . $work4['work_title'] . '</h3></a>' : '';
            ?>
            <?php echo $work4['work_subtitle'] ? '<p>' . $work4['work_subtitle'] . '</p>' : '' ?>
          </div>
          <div class="bento-card-details">
            <?php echo isset($work4['work_image']['url']) ? '<img src="' . esc_url($work4['work_image']['url']) . '">' : '' ?>
          </div>
        </div>
      <?php endif ?>

      <?php if (!empty(array_filter($work5))) : ?>
        <div class="grid-item bento-card grid-item05">
          <div class="bento-card-description">
            <?php
            $work5_link = !empty($work5['work_link']) ? esc_url($work5['work_link']) : esc_url($default_work_link);
            echo $work5['work_title'] ? '<a class="bento-link" href="' . $work5_link . '"><h3 class="bento-title">' . $work5['work_title'] . '</h3></a>' : '';
            ?>
            <?php echo $work5['work_subtitle'] ? '<p>' . $work5['work_subtitle'] . '</p>' : '' ?>
          </div>
          <div class="bento-card-details">
            <?php echo isset($work5['work_image']['url']) ? '<img src="' . esc_url($work5['work_image']['url']) . '">' : '' ?>
          </div>
        </div>
      <?php endif ?>

      <?php if (!empty(array_filter($work6))) : ?>
        <div class="grid-item bento-card grid-item06">
          <div class="bento-card-description">
            <?php
            $work6_link = !empty($work6['work_link']) ? esc_url($work6['work_link']) : esc_url($default_work_link);
            echo $work6['work_title'] ? '<a class="bento-link" href="' . $work6_link . '"><h3 class="bento-title">' . $work6['work_title'] . '</h3></a>' : '';
            ?>
            <?php echo $work6['work_subtitle'] ? '<p>' . $work6['work_subtitle'] . '</p>' : '' ?>
          </div>
          <div class="bento-card-details">
            <?php echo isset($work6['work_image']['url']) ? '<img src="' . esc_url($work6['work_image']['url']) . '">' : '' ?>
          </div>
        </div>
      <?php endif ?>
    </div>
  </div>
</section>