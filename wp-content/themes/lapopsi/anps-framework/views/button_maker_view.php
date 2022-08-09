<?php
include_once(get_template_directory() . '/anps-framework/classes/AnpsOptions.php');
include_once(get_template_directory() . '/anps-framework/classes/AnpsStyle.php');

wp_enqueue_style('anps-colorpicker');
wp_enqueue_script('vue');
wp_enqueue_script('anps-colorpicker-theme');
wp_enqueue_script('anps-colorpicker-custom');
wp_enqueue_script('anps-button-maker');

if(isset($_GET['save_options'])) {
    $anps_options->anps_save_options('button_maker');
}
?>
<form action="themes.php?page=theme_options&sub_page=button_maker&save_options" method="post">
    <div class="content-inner">
        <!-- Button Colors -->
        <div class="row">
            <div class="col-md-12 ">
                <h3><i class="fa fa-tint"></i><?php esc_html_e("Button Colors", 'lapopsi'); ?></h3>
            </div>
        </div>


        <!-- Button maker -->

        <div id="button-maker" class="button-maker">
            <button-add></button-add>
            <div :key="button.id" class="button-maker__item" v-for="(button) in buttons">
                <div class="button-maker__header">
                    <button-name :button="button"></button-name>
                    <button-default :button="button"></button-default>
                    <button-secondary :button="button"></button-secondary>
                    <button-menu :button="button"></button-menu>
                    <button-remove :button="button"></button-remove>
                </div>
                <button-preview
                    :normal-style="button.normalStyle"
                    :hover-style="button.hoverStyle"
                    :type="button.type"
                    :shadow="button.shadow"
                ></button-preview>
                <button-options :button="button"></button-options>
            </div>
        </div>
    </div>

    <input name="anps-buttons" id="anps-buttons" type="hidden" value='<?php echo get_option('anps-buttons', '{"defaultButton":0,"secondaryButton":1,"buttons":[{"name":"Main button","type":"gradient","normalStyle":{"color":"ffffff","background-color-1":"53caf2","background-color-2":"17c5ff","border-radius":"5","box-shadow":""},"hoverStyle":{},"id":0},{"name":"Normal button","type":"normal","normalStyle":{"background-color":"eceff4","border-radius":"5","box-shadow":"","color":"878a9d"},"hoverStyle":{"background-color":"e2e5eb","color":"6a6e85"},"id":1},{"name":"Border button","type":"border","normalStyle":{"color":"383e48","background-color":"","border-color":"3acbfd","border-radius":"5","border-width":"2"},"hoverStyle":{"background-color":"","border-color":"3acbfd","color":"3acbfd"},"id":2},{"name":"Text button","type":"text","normalStyle":{"color":"383e48"},"hoverStyle":{"color":"3acbfd"},"id":3}],"menuButton":2}'); ?>'>

    <script type="text/x-template" id="button-preview">
        <div class="button-maker__preview">
            <button
                @mouseleave="changeState('normal')"
                @mouseover="changeState('hover')"
                :class="classAttr"
                :style="styleAttr">Button text
            </button>
        </div>
    </script>

    <script type="text/x-template" id="button-add">
        <div class="button-maker__add">
            <label>Add new button</label>
            <select ref="type">
                <option value="normal">Normal button</option>
                <option value="gradient">Gradient background button</option>
                <option value="text">Text only button</option>
                <option value="border">Border button</option>
            </select>
            <button type="button" @click="add">Add</button>
        </div>
    </script>

    <script type="text/x-template" id="button-name">
        <div @mouseover="allowEdit" @mouseleave="disableEdit" class="button-maker__name">
            <span>Button name:</span>
            <input v-model="button.name">
        </div>
    </script>

    <script type="text/x-template" id="button-default">
        <div class="button-maker__pos">
            <input :checked="button.id === state.defaultButton" @click="setDefault" :id="id" type="checkbox">
            <label :for="id">Default button</label>
        </div>
    </script>

    <script type="text/x-template" id="button-secondary">
        <div class="button-maker__pos">
            <input :checked="button.id === state.secondaryButton" @click="setSecondary" :id="id" type="checkbox">
            <label :for="id">Secondary button</label>
        </div>
    </script>

    <script type="text/x-template" id="button-menu">
        <div class="button-maker__pos">
            <input :checked="button.id === state.menuButton" @click="setMenu" :id="id" type="checkbox">
            <label :for="id">Menu button</label>
        </div>
    </script>

    <script type="text/x-template" id="button-remove">
        <button
            type="button"
            class="button-maker__remove"
            v-show="state.buttons.length > 1"
            @click="remove"><i class="fa fa-close"></i>
        </button>
    </script>

    <script type="text/x-template" id="button-color">
        <div class="button-maker__color">
            <span @click="focus" class="button-maker__color-preview" :style="stylePreview"></span>
            <input class="button-maker__input button-maker__input--color" ref="field" type="text" @input="changeColor" :value="color">
        </div>
    </script>

    <script type="text/x-template" id="button-options">
        <div ref="options" class="button-maker__options">
            <div class="button-maker__col" v-if="button.type === 'normal' ||
                       button.type === 'gradient' ||
                       button.type === 'text' ||
                       button.type === 'border'">
                <label>Color</label>
                <button-color
                    :button="button"
                    type="normalStyle"
                    prop="color"
                ></button-color>
            </div>
            <div class="button-maker__col" v-if="button.type === 'normal' || button.type === 'border'">
                <label>Background color</label>
                <button-color
                    :button="button"
                    type="normalStyle"
                    prop="background-color"
                ></button-color>
            </div>
            <div class="button-maker__col" v-if="button.type === 'gradient'">
                <label>Gradient color 1</label>
                <button-color
                    :button="button"
                    type="normalStyle"
                    prop="background-color-1"
                ></button-color>
            </div>
            <div class="button-maker__col" v-if="button.type === 'gradient'">
                <label>Gradient color 2</label>
                <button-color
                    :button="button"
                    type="normalStyle"
                    prop="background-color-2"
                ></button-color>
            </div>
            <div class="button-maker__col" v-if="button.type === 'normal' ||
                                                 button.type === 'gradient'">
                <label>Shadow color</label>
                <button-color
                    :button="button"
                    type="normalStyle"
                    prop="box-shadow"
                ></button-color>
            </div>
            <div class="button-maker__col" v-if="button.type === 'border'">
                <label>Border color</label>
                <button-color
                    :button="button"
                    type="normalStyle"
                    prop="border-color"
                ></button-color>
            </div>
            <div class="button-maker__col" v-if="button.type === 'border'">
                <label>Border width</label>
                <input class="button-maker__input" v-model="button.normalStyle['border-width']" min="0" type="number">
            </div>
            <div class="button-maker__col" v-if="button.type === 'normal' ||
                       button.type === 'gradient' ||
                       button.type === 'border'">
                <label>Border radius</label>
                <input class="button-maker__input" v-model="button.normalStyle['border-radius']" min="0" type="number">
            </div>
            <div class="button-maker__col" v-if="button.type === 'normal' ||
                       button.type === 'text' ||
                       button.type === 'border'">
                <label>Hover color</label>
                <button-color
                    :button="button"
                    type="hoverStyle"
                    prop="color"
                ></button-color>
            </div>
            <div class="button-maker__col" v-if="button.type === 'normal' || button.type === 'border'">
                <label>Hover background color</label>
                <button-color
                    :button="button"
                    type="hoverStyle"
                    prop="background-color"
                ></button-color>
            </div>
            <div class="button-maker__col" v-if="button.type === 'border'">
                <label>Hover border color</label>
                <button-color
                    :button="button"
                    type="hoverStyle"
                    prop="border-color"
                ></button-color>
            </div>
        </div>
    </script>

    <!-- Save form -->
    <?php $anps_options->anps_save_button(); ?>
</form>
