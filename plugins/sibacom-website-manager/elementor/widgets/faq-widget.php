<?php
/**
 * SIBACOM FAQ Elementor Widget
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

class SIBACOM_FAQ_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_faq';
    }

    public function get_title() {
        return esc_html__('SIBACOM FAQ Accordion', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        // CONTENT TAB
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__('FAQ Configuration & Questions', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'data_mode',
            array(
                'label'   => esc_html__('Data Source Mode', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'dynamic',
                'options' => array(
                    'dynamic' => esc_html__('Dynamic (WordPress SIBACOM FAQs CPT)', 'sibacom-manager'),
                    'manual'  => esc_html__('Custom Manual Questions (Visual Repeater)', 'sibacom-manager'),
                ),
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'question',
            array(
                'label'   => esc_html__('Question', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'What is SIBACOM 2026?',
            )
        );

        $repeater->add_control(
            'answer',
            array(
                'label'   => esc_html__('Answer', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'SIBACOM (Sukkur IBA Annual Mega Olympiad) is the flagship collegiate technology, hackathon, and innovation summit presented by Sukkur IBA University.',
            )
        );

        $this->add_control(
            'manual_faqs',
            array(
                'label'       => esc_html__('Manual FAQ Items', 'sibacom-manager'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ question }}}',
                'condition'   => array(
                    'data_mode' => 'manual',
                ),
            )
        );

        $this->end_controls_section();

        // STYLE TAB
        $this->start_controls_section(
            'section_style_faq',
            array(
                'label' => esc_html__('Accordion Appearance', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'item_bg',
            array(
                'label'     => esc_html__('Item Background Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-accordion-item' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'question_typography',
                'label'    => esc_html__('Question Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-accordion-header span',
            )
        );

        $this->add_control(
            'question_color',
            array(
                'label'     => esc_html__('Question Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#17233D',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-accordion-header span' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'item_shadow',
                'label'    => esc_html__('Item Shadow', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-accordion-item',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $mode     = $settings['data_mode'];

        if ($mode === 'dynamic') {
            if (class_exists('SIBACOM_Shortcodes')) {
                echo SIBACOM_Shortcodes::render_faq(array());
            }
        } else {
            $faqs = !empty($settings['manual_faqs']) ? $settings['manual_faqs'] : array();
            ?>
            <div class="sibacom-accordion">
                <?php
                $count = 0;
                foreach ($faqs as $f) :
                    $count++;
                    $is_first = ($count === 1) ? 'active' : '';
                    ?>
                    <div class="sibacom-accordion-item neu-card <?php echo esc_attr($is_first); ?>">
                        <div class="sibacom-accordion-header">
                            <span><?php echo esc_html($f['question']); ?></span>
                            <div class="sibacom-accordion-icon">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="sibacom-accordion-content">
                            <p><?php echo esc_html($f['answer']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }
}
