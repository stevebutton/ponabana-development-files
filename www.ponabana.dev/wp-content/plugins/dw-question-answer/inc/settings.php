<?php  


//Create global variables for storing plugins settings
function dwqa_init_options(){
    global $dwqa_options;
    $dwqa_options = wp_parse_args( get_option( 'dwqa_options' ), array( 
        'pages'     => array(
                'submit-question'   =>  0,
                'archive-question'     => 0
            ),
        'question-registration'     => false
        
    ) );

}
add_action( 'init', 'dwqa_init_options' );

// Create admin menus for backend
function dwqa_admin_menu(){
    global $dwqa_setting_page;
    $dwqa_setting_page = add_submenu_page( 
        'edit.php?post_type=dwqa-question', 
        __('Plugin Settings','dwqa'), 
        __('Settings','dwqa'), 
        'manage_options', 
        'dwqa-settings', 
        'dwqa_settings_display' 
    );
}   
add_action( 'admin_menu', 'dwqa_admin_menu' );

// Display settings form of DW Q&A
function dwqa_settings_display(){
    global $dwqa_options;
    ?>
    <div class="wrap">
        <h2><?php _e('DWQA Settings', 'dwqa') ?></h2>
        <?php settings_errors(); ?>  

        <?php if( isset( $_GET[ 'tab' ] ) ) {  
            $active_tab = $_GET[ 'tab' ];  
        } else {  
            $active_tab = 'general';  
        } // end if/else ?>  
        
        <h2 class="nav-tab-wrapper">  
            <a href="?post_type=dwqa-question&amp;page=dwqa-settings&amp;tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>"><?php _e('General','dwqa'); ?></a> 
            <a href="?post_type=dwqa-question&amp;page=dwqa-settings&amp;tab=email" class="nav-tab <?php echo $active_tab == 'email' ? 'nav-tab-active' : ''; ?>"><?php _e('Notification','dwqa'); ?></a> 
            <a href="?post_type=dwqa-question&amp;page=dwqa-settings&amp;tab=permission" class="nav-tab <?php echo $active_tab == 'permission' ? 'nav-tab-active' : ''; ?>"><?php _e('Permission','dwqa'); ?></a> 
        </h2>  
          
        <form method="post" action="options.php">  
        <?php  
            if( 'email' == $active_tab ) {
                echo '<div class="dwqa-notification-settings">';
                settings_fields( 'dwqa-subscribe-settings' );
                dwqa_subscrible_email_logo_display();
                echo '<h3>'.__('New Question Notification','dwqa').'</h3>';
                dwqa_subscrible_new_question_email_subject_display();
                dwqa_subscrible_new_question_email_display();
                submit_button( __('Save all changes','dwqa') );
                echo '<hr>';
                echo '<h3>'.__('New Answer Notification','dwqa'). '</h3>';
                dwqa_subscrible_new_answer_email_subject_display();
                dwqa_subscrible_new_answer_email_display();
                submit_button( __('Save all changes','dwqa') );
                echo '<hr>';
                echo '<h3>'.__('New Comment to Question Notification','dwqa'). '</h3>';
                dwqa_subscrible_new_comment_question_email_subject_display();
                dwqa_subscrible_new_comment_question_email_display();
                submit_button( __('Save all changes','dwqa') );
                echo '<hr>';
                echo '<h3>'.__('New Comment to Answer Notification','dwqa'). '</h3>';
                dwqa_subscrible_new_comment_answer_email_subject_display();
                dwqa_subscrible_new_comment_answer_email_display();
                submit_button( __('Save all changes','dwqa') );
                echo '</div>';
            } elseif ( 'permission' == $active_tab ) {
                echo '<h3>'.__('Group permission settings','dwqa'). '</h3>';
                settings_fields( 'dwqa-permission-settings' );
                dwqa_permission_display();
                submit_button();
            } else {
                settings_fields( 'dwqa-settings' );
                do_settings_sections( 'dwqa-settings' );
                submit_button();
            }
        ?>
        </form>  
    </div>
    <?php
}

function dwqa_register_settings(){
    global  $dwqa_general_settings;

    //Register Setting Sections
    add_settings_section( 
        'dwqa-general-settings', 
        false, 
        null, 
        'dwqa-settings' 
    );
    
    add_settings_field( 
        'dwqa_options[pages][question-registration]', 
        __('Login Restriction', 'dwqa'), 
        'dwqa_question_registration_setting_display', 
        'dwqa-settings', 
        'dwqa-general-settings'
    );

    add_settings_field( 
        'dwqa_options[pages][archive-question]', 
        __('Question List Page', 'dwqa'), 
        'dwqa_pages_settings_display', 
        'dwqa-settings', 
        'dwqa-general-settings'
    );

    add_settings_field( 
        'dwqa_options[pages][submit-question]', 
        __('Ask Question Page', 'dwqa'), 
        'dwqa_submit_question_page_display', 
        'dwqa-settings', 
        'dwqa-general-settings'
    );
    //Time setting
    add_settings_section( 
        'dwqa-time-settings', 
        __('Time settings','dwqa'), 
        null, 
        'dwqa-settings' 
    );

    add_settings_field( 
        'dwqa_options[question-new-time-frame]', 
        __('New Question Time Frame', 'dwqa'), 
        'dwqa_question_new_time_frame_display', 
        'dwqa-settings', 
        'dwqa-time-settings'
    );

    add_settings_field( 
        'dwqa_options[question-overdue-time-frame]', 
        __('Question Overdue - Time Frame', 'dwqa'), 
        'dwqa_question_overdue_time_frame_display', 
        'dwqa-settings', 
        'dwqa-time-settings'
    );

    //Permalink
    add_settings_section( 
        'dwqa-permalink-settings', 
        __('Permalink Settings','dwqa'), 
        create_function('', '_e(\'Custom permalinks for single questions, categories, tags.\',\'dwqa\'); '), 
        'dwqa-settings' 
    );

    add_settings_field( 
        'dwqa_options[question-rewrite]', 
        __('Single Question', 'dwqa'), 
        'dwqa_question_rewrite_display', 
        'dwqa-settings', 
        'dwqa-permalink-settings'
    );

    add_settings_field( 
        'dwqa_options[question-category-rewrite]', 
        __('Single Category', 'dwqa'), 
        'dwqa_question_category_rewrite_display', 
        'dwqa-settings', 
        'dwqa-permalink-settings'
    );

    add_settings_field( 
        'dwqa_options[question-tag-rewrite]', 
        __('Single Tag', 'dwqa'), 
        'dwqa_question_tag_rewrite_display', 
        'dwqa-settings', 
        'dwqa-permalink-settings'
    );

    register_setting( 'dwqa-settings', 'dwqa_options');


    add_settings_section( 
        'dwqa-subscribe-settings', 
        false,
        false,
        'dwqa-email' 
    );

    add_settings_field( 
        'dwqa_subscrible_email_logo', 
        __('Email Logo', 'dwqa'), 
        'dwqa_subscrible_email_logo_display', 
        'dwqa-email', 
        'dwqa-subscribe-settings'
    );

    register_setting( 'dwqa-subscribe-settings', 'dwqa_subscrible_email_logo');


    add_settings_field( 
        'dwqa_subscrible_new_question_email_subject',
        __('New Question Notification Subject','dwqa'),
        'dwqa_subscrible_new_question_email_subject_display', 'dwqa-email',
        'dwqa-subscribe-settings' 
    );
    add_settings_field( 
        'dwqa_subscrible_new_question_email', 
        __('New Question Notification', 'dwqa'), 
        'dwqa_subscrible_new_question_email_display', 
        'dwqa-email', 
        'dwqa-subscribe-settings'
    );
    register_setting( 'dwqa-subscribe-settings', 'dwqa_subscrible_new_question_email' );
    register_setting( 'dwqa-subscribe-settings', 'dwqa_subscrible_new_question_email_subject' );



    add_settings_field( 
        'dwqa_subscrible_new_answer_email_subject',
        __('New Answer Notification Subject','dwqa'),
        'dwqa_subscrible_new_answer_email_subject_display', 'dwqa-email',
        'dwqa-subscribe-settings' 
    );
    add_settings_field( 
        'dwqa_subscrible_new_answer_email', 
        __('New Answer Notification', 'dwqa'), 
        'dwqa_subscrible_new_answer_email_display', 
        'dwqa-email', 
        'dwqa-subscribe-settings'
    );
    register_setting( 'dwqa-subscribe-settings', 'dwqa_subscrible_new_answer_email' );
    register_setting( 'dwqa-subscribe-settings', 'dwqa_subscrible_new_answer_email_subject' );



    add_settings_field( 
        'dwqa_subscrible_new_comment_question_email_subject',
        __('New Comment Question Notification Subject','dwqa'),
        'dwqa_subscrible_new_comment_question_email_subject_display', 
        'dwqa-email',
        'dwqa-subscribe-settings' 
    );
    add_settings_field( 
        'dwqa_subscrible_new_comment_question_email', 
        __('New comment of question notify', 'dwqa'), 
        'dwqa_subscrible_new_comment_question_email_display', 
        'dwqa-email', 
        'dwqa-subscribe-settings'
    );
    register_setting( 'dwqa-subscribe-settings', 'dwqa_subscrible_new_comment_question_email_subject' );
    register_setting( 'dwqa-subscribe-settings', 'dwqa_subscrible_new_comment_question_email' );


    add_settings_field( 
        'dwqa_subscrible_new_comment_answer_email_subject',
        __('New Comment Answer Notification Subject','dwqa'),
        'dwqa_subscrible_new_comment_answer_email_subject_display', 
        'dwqa-email',
        'dwqa-subscribe-settings' 
    );
    add_settings_field( 
        'dwqa_subscrible_new_comment_answer_email', 
        __('New comment of answer notify', 'dwqa'), 
        'dwqa_subscrible_new_comment_answer_email_display', 
        'dwqa-email', 
        'dwqa-subscribe-settings'
    );
    register_setting( 'dwqa-subscribe-settings', 'dwqa_subscrible_new_comment_answer_email_subject' );
    register_setting( 'dwqa-subscribe-settings', 'dwqa_subscrible_new_comment_answer_email' );

    add_settings_section( 
        'dwqa-permission-settings', 
        __('Group Permission','dwqa'),
        false,
        'dwqa-permission' 
    );

    add_settings_field( 
        'dwqa_permission', 
        __('Group Permission','dwqa'), 
        'dwqa_permission_display', 
        'dwqa-permission', 
        'dwqa-permission-settings' 
    );

    register_setting( 'dwqa-permission-settings', 'dwqa_permission' );

}
add_action( 'admin_init', 'dwqa_register_settings' );

// Callback for dwqa-general-settings Option
function dwqa_question_registration_setting_display(){
    global  $dwqa_general_settings;
    ?>
    <p><input type="checkbox" name="dwqa_options[answer-registration]" value="true" <?php checked( true, isset($dwqa_general_settings['answer-registration']) ? (bool) $dwqa_general_settings['answer-registration'] : false ) ; ?> id="dwqa_option_answer_registation">
    <label for="dwqa_option_answer_registation"><span class="description"><?php _e('Login required. No anonymous allowed','dwqa'); ?></span></label></p>
    <?php
}

function dwqa_pages_settings_display(){
    global  $dwqa_general_settings;
    $archive_question_page = isset($dwqa_general_settings['pages']['archive-question']) ? $dwqa_general_settings['pages']['archive-question'] : 0; 
    ?>
    <p>
        <?php
            wp_dropdown_pages( array(
                'name'              => 'dwqa_options[pages][archive-question]',
                'show_option_none'  => __('Select Archive Question Page','dwqa'),
                'option_none_value' => 0,
                'selected'          => $archive_question_page
            ) );
        ?><span class="description"><?php _e('A page where displays all questions','dwqa') ?></span>
    </p>
    <?php
}

function dwqa_question_new_time_frame_display(){ 
    global  $dwqa_general_settings;
    echo '<p><input type="text" name="dwqa_options[question-new-time-frame]" id="dwqa_options_question_new_time_frame" value="'.( isset( $dwqa_general_settings['question-new-time-frame'] ) ? $dwqa_general_settings['question-new-time-frame'] : 4 ).'" class="small-text" /><span class="description"> '.__('hours','dwqa').'<span title="'.__('A period of time in which new questions are highlighted and marked as New','dwqa').'">(?)</span></span></p>';
}

function dwqa_question_overdue_time_frame_display(){ 
    global  $dwqa_general_settings;
    echo '<p><input type="text" name="dwqa_options[question-overdue-time-frame]" id="dwqa_options_question_new_time_frame" value="'.( isset( $dwqa_general_settings['question-overdue-time-frame'] ) ? $dwqa_general_settings['question-overdue-time-frame'] : 2 ).'" class="small-text" /><span class="description"> '.__('days','dwqa').'<span title="'.__('A Question will be marked as overdue if passes this period of time, starting from the date the question was submitted','dwqa').'">(?)</span></span></p>';
}

function dwqa_submit_question_page_display(){
    global  $dwqa_general_settings;
    $submit_question_page = isset($dwqa_general_settings['pages']['submit-question']) ? $dwqa_general_settings['pages']['submit-question'] : 0; 
    ?>
    <p>
        <?php
            wp_dropdown_pages( array(
                'name'              => 'dwqa_options[pages][submit-question]',
                'show_option_none'  => __('Select Submit Question Page','dwqa'),
                'option_none_value' => 0,
                'selected'          => $submit_question_page
            ) );
        ?>
        <span class="description"><?php _e('A page where users can submit questions.
','dwqa') ?></span>
    </p>
    <?php
}
function dwqa_email_template_settings_display(){
    global $dwqa_options;
    $editor_content = isset( $dwqa_options['subscribe']['email-template'] ) ? $dwqa_options['subscribe']['email-template'] : '';
    wp_editor( $editor_content, 'dwqa_email_template_editor', array(
        'textarea_name' => 'dwqa_options[subscribe][email-template]'
    ) );
}


function dwqa_subscrible_email_logo_display(){
    ?>
    <div class="uploader">
        <p><?php _e('Email logo','dwqa') ?></p>
        <p><input type="text" name="dwqa_subscrible_email_logo" id="dwqa_subscrible_email_logo" class="regular-text" value="<?php echo  get_option( 'dwqa_subscrible_email_logo' ); ?>" />&nbsp;<input type="button" class="button" name="dwqa_subscrible_email_logo_button" id="dwqa_subscrible_email_logo_button" value="<?php _e('Upload','dwqa') ?>" /><span class="description">&nbsp;<?php _e('Upload or choose a logo to be displayed at the top of the email','dwqa') ?></span></p>
    </div>
    <script type="text/javascript">
    jQuery(document).ready(function($){
      var _custom_media = true,
          _orig_send_attachment = wp.media.editor.send.attachment;

      $('#dwqa_subscrible_email_logo_button').click(function(e) {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = $(this);
        var id = button.attr('id').replace('_button', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
          if ( _custom_media ) {
            $("#"+id).val(attachment.url);

            if( $( "#"+id ).closest('.uploader').find('.logo-preview').length > 0 ) {
                $( "#"+id ).closest('.uploader').find('.logo-preview img').attr('src', attachment.url);
            }else {
                $( "#"+id ).closest('.uploader').append('<p class="logo-preview"><img src="'+attachment.url+'"></p>')
            }
          } else {
            return _orig_send_attachment.apply( this, [props, attachment] );
          };
        }

        wp.media.editor.open(button);
        return false;
      });

      $('.add_media').on('click', function(){
        _custom_media = false;
      });
    });
    </script>
    <?php
}

function dwqa_subscrible_new_question_email_subject_display(){ 
    echo '<p><label for="dwqa_subscrible_new_question_email_subject">'.__('Email subject','dwqa').'<br><input type="text" id="dwqa_subscrible_new_question_email_subject" name="dwqa_subscrible_new_question_email_subject" value="'.get_option( 'dwqa_subscrible_new_question_email_subject' ).'" class="widefat" /></span></p>';
}

function dwqa_subscrible_new_question_email_display(){
    echo '<label for="dwqa_subscrible_new_question_email">'.__('Email Content','dwqa').'<br>';
    $content = dwqa_get_mail_template( 'dwqa_subscrible_new_question_email', 'new-question' );
    wp_editor( $content, 'dwqa_subscrible_new_question_email', array(
        'wpautop'   => false,
        'tinymce' => array( 
            'content_css' => DWQA_URI . 'assets/css/email-template-editor.css'
        ) 
    ) );
    echo '<p><input data-template="new-question.html" type="button" class="button dwqa-reset-email-template" value="Reset Template"></p>';
    echo '<div class="description">
        Enter the email that is sent to Administrator when have new question on your site. HTML is accepted. Available template settings:<br>
        <strong>{site_logo}</strong> - Your site logo <br />
        <strong>{site_name}</strong> - Your site name <br />
        <strong>{user_avatar}</strong> - Question Author Avatar <br />
        <strong>{username}</strong> - Question Author Name <br />
        <strong>{user_link}</strong> - Question Author Posts Link<br />
        <strong>{question_title}</strong> - Question Title <br />
        <strong>{question_link}</strong> - Question Link <br />
        <strong>{question_content}</strong> - Question Content <br />
    </div>';
    echo '</label>';
}


function dwqa_subscrible_new_answer_email_display(){
    echo '<label for="dwqa_subscrible_new_answer_email">'.__('Email Content','dwqa').'<br>';
    $content = dwqa_get_mail_template( 'dwqa_subscrible_new_answer_email', 'new-answer' );
    wp_editor( $content, 'dwqa_subscrible_new_answer_email', array(
        'wpautop'   => false,
        'tinymce' => array( 
            'content_css' => DWQA_URI . 'assets/css/email-template-editor.css'
        ) 
    ) );
    echo '<p><input data-template="new-answer.html" type="button" class="button dwqa-reset-email-template" value="Reset Template"></p>';
    echo '<div class="description">
        Enter the email that is sent to Administrator when have new answer on your site. HTML is accepted. Available template settings:<br>
        <strong>{site_logo}</strong> - Your site logo <br />
        <strong>{site_name}</strong> - Your site name <br />
        <strong>{site_description}</strong> - Your site description <br />
        <strong>{answer_avatar}</strong> - Answer Author Avatar <br />
        <strong>{answer_author}</strong> - Answer Author Name <br />
        <strong>{answer_author_link}</strong> - Answer Author Link <br />
        <strong>{question_title}</strong> - Question Title <br />
        <strong>{question_link}</strong> - Question Link <br />
        <strong>{answer_content}</strong> - Answer Content <br />

    </div>';
    echo '</label>';
}

function dwqa_subscrible_new_answer_email_subject_display(){ 
    echo '<p><label for="dwqa_subscrible_new_answer_email_subject">'.__('Email subject','dwqa').'<br><input type="text" id="dwqa_subscrible_new_answer_email_subject" name="dwqa_subscrible_new_answer_email_subject" value="'.get_option( 'dwqa_subscrible_new_answer_email_subject' ).'" class="widefat" /></span></p>';
}

function dwqa_subscrible_new_comment_question_email_display(){
    echo '<label for="dwqa_subscrible_new_comment_question_email">'.__('Email Content','dwqa').'<br>';
    $content = dwqa_get_mail_template( 'dwqa_subscrible_new_comment_question_email', 'new-comment-question' );
    wp_editor( $content, 'dwqa_subscrible_new_comment_question_email', array(
        'wpautop'   => false,
        'tinymce' => array( 
            'content_css' => DWQA_URI . 'assets/css/email-template-editor.css'
        ) 
    ) );
    echo '<p><input data-template="new-comment-question.html" type="button" class="button dwqa-reset-email-template" value="Reset Template"></p>';
    echo '<div class="description">
        Enter the email that is sent to Administrator when have new answer on your site. HTML is accepted. Available template settings:<br>
        <strong>{site_logo}</strong> - Your site logo <br />
        <strong>{site_name}</strong> - Your site name <br />
        <strong>{site_description}</strong> - Your site description <br />
        <strong>{question_author}</strong> - Question Author Name <br />
        <strong>{comment_author}</strong> - Comment Author Name <br />
        <strong>{comment_author_avatar}</strong> - Comment Author Avatar <br />
        <strong>{comment_author_link}</strong> - Comment Author Link <br />
        <strong>{question_title}</strong> - Question Title <br />
        <strong>{question_link}</strong> - Question Link <br />
        <strong>{comment_content}</strong> - Comment Content <br />
    </div>';
    echo '</label>';
}
function dwqa_subscrible_new_comment_question_email_subject_display(){ 
    echo '<p><label for="dwqa_subscrible_new_comment_question_email_subject">'.__('Email subject','dwqa').'<br><input type="text" id="dwqa_subscrible_new_comment_question_email_subject" name="dwqa_subscrible_new_comment_question_email_subject" value="'.get_option( 'dwqa_subscrible_new_comment_question_email_subject' ).'" class="widefat" /></label></p>';
}

function dwqa_subscrible_new_comment_answer_email_display(){
    echo '<label for="dwqa_subscrible_new_comment_answer_email">'.__('Email Content','dwqa').'<br>';
    $content = dwqa_get_mail_template( 'dwqa_subscrible_new_comment_answer_email', 'new-comment-answer' );
    wp_editor( $content, 'dwqa_subscrible_new_comment_answer_email', array(
        'wpautop'   => false,
        'tinymce' => array( 
            'content_css' => DWQA_URI . 'assets/css/email-template-editor.css'
        ) 
    ) );
    echo '<p><input data-template="new-comment-answer.html" type="button" class="button dwqa-reset-email-template" value="Reset Template"></p>';
    echo '<div class="description">
        Enter the email that is sent to Administrator when have new answer on your site. HTML is accepted. Available template settings:<br>
        <strong>{site_logo}</strong> - Your site logo <br />
        <strong>{site_name}</strong> - Your site name <br />
        <strong>{site_description}</strong> - Your site description <br />
        <strong>{answer_author}</strong> - Answer Author Name <br />
        <strong>{comment_author}</strong> - Comment Author Name <br />
        <strong>{comment_author_avatar}</strong> - Comment Author Avatar <br />
        <strong>{comment_author_link}</strong> - Comment Author Link <br />
        <strong>{question_title}</strong> - Question Title <br />
        <strong>{question_link}</strong> - Question Link <br />
        <strong>{comment_content}</strong> - Comment Content <br />
    </div>';
    echo '</label>';
}

function dwqa_subscrible_new_comment_answer_email_subject_display(){ 
    echo '<p><label for="dwqa_subscrible_new_comment_answer_email_subject">'.__('Email subject','dwqa').'<br><input type="text" id="dwqa_subscrible_new_comment_answer_email_subject" name="dwqa_subscrible_new_comment_answer_email_subject" value="'.get_option( 'dwqa_subscrible_new_comment_answer_email_subject' ).'" class="widefat" /></label></p>';
}

function dwqa_question_rewrite_display(){
    global  $dwqa_general_settings;
    echo '<p><input type="text" name="dwqa_options[question-rewrite]" id="dwqa_options_question_rewrite" value="'.( isset( $dwqa_general_settings['question-rewrite'] ) ? $dwqa_general_settings['question-rewrite'] : 'question' ).'" class="regular-text" /></p>';
}

function dwqa_question_category_rewrite_display(){
    global  $dwqa_general_settings;
    echo '<p><input type="text" name="dwqa_options[question-category-rewrite]" id="dwqa_options_question_category_rewrite" value="'.( isset( $dwqa_general_settings['question-category-rewrite'] ) ? $dwqa_general_settings['question-category-rewrite'] : 'question-category' ).'" class="regular-text" /></p>';
}

function dwqa_question_tag_rewrite_display(){
    global  $dwqa_general_settings;
    echo '<p><input type="text" name="dwqa_options[question-tag-rewrite]" id="dwqa_options_question_tag_rewrite" value="'.( isset( $dwqa_general_settings['question-tag-rewrite'] ) ? $dwqa_general_settings['question-tag-rewrite'] : 'question-tag' ).'" class="regular-text" /></p>';
}

function dwqa_permission_display(){
    global $dwqa_permission;
    $perms = $dwqa_permission->perms;
    ?>
    <table class="table widefat dwqa-permission-settings">
        <thead>
            <tr>
                <th></th>
                <th colspan="4"><?php _e('Question','dwqa') ?></th>
                <th colspan="4"><?php _e('Answer','dwqa') ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th></th>
                <th>Read</th>
                <th>Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Read</th>
                <th>Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php  
                $roles = get_editable_roles();
                foreach ($dwqa_permission->defaults as $key => $role) {
                    if( $key == 'anonymous' ) {
                        continue;
                    }
            ?>
            <tr class="group available">
                <td><?php echo $roles[$key]['name'] ?></td>
                <td><input type="checkbox" <?php checked( true, $perms[$key]['question']['read'] ); disabled( true, $perms[$key]['disabled']  ); ?> name="dwqa_permission[<?php echo $key ?>][question][read]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms[$key]['question']['post'] ); disabled( true, $perms[$key]['disabled']  ); ?> name="dwqa_permission[<?php echo $key ?>][question][post]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms[$key]['question']['edit'] ); disabled( true, $perms[$key]['disabled']  ); ?> name="dwqa_permission[<?php echo $key ?>][question][edit]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms[$key]['question']['delete'] ); disabled( true, $perms[$key]['disabled']  ); ?> name="dwqa_permission[<?php echo $key ?>][question][delete]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms[$key]['answer']['read'] ); disabled( true, $perms[$key]['disabled']  ); ?> name="dwqa_permission[<?php echo $key ?>][answer][read]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms[$key]['answer']['post'] ); disabled( true, $perms[$key]['disabled']  ); ?> name="dwqa_permission[<?php echo $key ?>][answer][post]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms[$key]['answer']['edit'] ); disabled( true, $perms[$key]['disabled']  ); ?> name="dwqa_permission[<?php echo $key ?>][answer][edit]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms[$key]['answer']['delete'] ); disabled( true, $perms[$key]['disabled']  ); ?> name="dwqa_permission[<?php echo $key ?>][answer][delete]" value="1"></td>
            </tr>
            <?php
                }
            ?>
            <tr class="group available">
                <td><?php _e('Anonymous','dwqa') ?></td>
                <td><input type="checkbox" <?php checked( true, $perms['anonymous']['question']['read'] ); disabled( true, $perms['anonymous']['disabled']  ); ?> name="dwqa_permission[<?php echo 'anonymous' ?>][question][read]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms['anonymous']['question']['post'] ); disabled( true, $perms['anonymous']['disabled']  ); ?> name="dwqa_permission[<?php echo 'anonymous' ?>][question][post]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms['anonymous']['question']['edit'] ); disabled( true, $perms['anonymous']['disabled']  ); ?> name="dwqa_permission[<?php echo 'anonymous' ?>][question][edit]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms['anonymous']['question']['delete'] ); disabled( true, $perms['anonymous']['disabled']  ); ?> name="dwqa_permission[<?php echo 'anonymous' ?>][question][delete]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms['anonymous']['answer']['read'] ); disabled( true, $perms['anonymous']['disabled']  ); ?> name="dwqa_permission[<?php echo 'anonymous' ?>][answer][read]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms['anonymous']['answer']['post'] ); disabled( true, $perms['anonymous']['disabled']  ); ?> name="dwqa_permission[<?php echo 'anonymous' ?>][answer][post]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms['anonymous']['answer']['edit'] ); disabled( true, $perms['anonymous']['disabled']  ); ?> name="dwqa_permission[<?php echo 'anonymous' ?>][answer][edit]" value="1"></td>
                <td><input type="checkbox" <?php checked( true, $perms['anonymous']['answer']['delete'] ); disabled( true, $perms['anonymous']['disabled']  ); ?> name="dwqa_permission[<?php echo $key ?>][answer][delete]" value="1"></td>
            </tr>
        </tbody>
    </table>
    <?php
}


?>