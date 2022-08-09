<?php
/* Require user to enter password */
if (post_password_required()) {
  echo '<p>' . esc_html__('This post is password protected. Enter the password to view any comments.', 'lapopsi') . '</p>';
  return;
}

/* Check if any comments are added */
if (have_comments()) {
  echo '<h4 id="comments" class="anps-heading anps-heading--comments"><span class="anps-heading__text">' . esc_html__('Comments', 'lapopsi') . ' (' . get_comments_number() . ')</span></h4>';

  /* List Comments */
  echo '<ol class="comments-list">';
  wp_list_comments(array('callback' => 'anps_comment'));
  echo '</ol>';

  /* Comments pagination */
  if (get_comment_pages_count() > 1 && get_option('page_comments')) {
    previous_comments_link();
    next_comments_link();
  }
} else {
  if (!comments_open()) {
    echo '<p class="no-comments">' . esc_html__('Comments are closed.', 'lapopsi') . '</p>';
  }
}

/* Comment form fields */
$fields =  array(
  'author' => '<div class="col-md-6"><fieldset class="form-group">
                        <input type="text" id="author" name="author" placeholder="' . esc_attr__('Name', 'lapopsi') . '">
                    </fieldset></div>',
  'email'  => '<div class="col-md-6"><fieldset class="form-group">
                        <input type="text" id="email" name="email" placeholder="' . esc_attr__('E-mail', 'lapopsi') . '">
                    </fieldset></div>'
);

$class_submit = 'anps-btn';

/* Comment form arguments */
if (anps_get_secondary_btn_class('md') !== false) {
  echo '<button id="reset" style="display: none;" class="' . anps_get_secondary_btn_class('md') . '" type="reset">' . esc_html__('Reset', 'lapopsi') . '</button>';
}

if (anps_get_default_btn_class('md') !== false) {
  $class_submit = anps_get_default_btn_class('md');
}

$args = array(
  'fields'       => apply_filters('comment_form_default_fields', $fields),
  'title_reply'  => '',
  'class_submit' => $class_submit,
);

/* If NOT logged in */
$args_specific = array(
  'comment_field'        => '<div class="col-md-12"><fieldset class="form-group">
                                    <textarea id="message" placeholder="' . esc_attr__("Comment", 'lapopsi') . '" name="comment" rows="2"></textarea>
                                </fieldset></div></div>',
  'logged_in_as'         => '<h4 class="anps-heading anps-heading--reply"><span class="anps-heading__text">' . esc_html__('Post comment', 'lapopsi') . '</span></h4>',
  'comment_notes_before' => '<h4 class="anps-heading anps-heading--reply"><span class="anps-heading__text">' . esc_html__('Post comment', 'lapopsi') . '</span></h4><div class="row contact-form">',
);

/* If logged in */
if (is_user_logged_in()) {
  $args_specific = array(
    'comment_field'        => '<div class="col-md-12">
                                            <fieldset class="form-group">
                                                <textarea id="message" placeholder="' . esc_attr__("Comment", 'lapopsi') . '" name="comment" rows="3"></textarea>
                                            </fieldset>
                                        </div></div>',
    'logged_in_as'         => '<h4 class="anps-heading anps-heading--reply"><span class="anps-heading__text">' . esc_html__('Leave a reply', 'lapopsi') . '</span></h4><div class="row contact-form">',
    'comment_notes_before' => '<h4 class="anps-heading anps-heading--reply"><span class="anps-heading__text">' . esc_html__('Leave a reply', 'lapopsi') . '</span></h4><div id="comment-form">',
  );
}

comment_form(array_merge($args, $args_specific));
