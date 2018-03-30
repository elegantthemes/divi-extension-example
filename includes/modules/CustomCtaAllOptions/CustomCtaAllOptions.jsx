// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class CustomCtaAllOptions extends Component {
  /**
   * Declare all component on-page styling on this method
   *
   * @since 1.0.0
   *
   * @return array
   */
  css() {
    const props = this.props;
    const utils = this.props.utils;
    const additionalCss = [];

    // Process text-align value into style
    if (utils.hasValue(props.text_align)) {
      additionalCss.push([{
        selector: '%%order_class%% .typography-fields',
        declaration: `text-align: ${props.text_align};`,
      }]);
    }

    // Process font option into style
    if (utils.hasValue(props.select_font)) {
      additionalCss.push([{
        selector: '%%order_class%% .typography-fields',
        declaration: utils.setElementFont(props.select_font),
      }]);
    }

    // Process color preview color
    if (utils.hasValue(props.color)) {
      additionalCss.push([{
        selector: '%%order_class%% .colorpicker-preview.color',
        declaration: `background-color: ${props.color};`,
      }]);
    }

    // Process color preview color alpha
    if (utils.hasValue(props.color_alpha)) {
      additionalCss.push([{
        selector: '%%order_class%% .colorpicker-preview.color-alpha',
        declaration: `background-color: ${props.color_alpha};`,
      }]);
    }

    return additionalCss;
  }

  /**
   * Custom method to render button UI
   *
   * @return object (JSX)
   */
  renderButton() {
    const props = this.props;
    const utils = this.props.utils;
    const buttonTarget = 'on' === props.url_new_window ? '_blank' : '';
    const isCustomButtonIcon = utils.hasValue(props.button_icon);
    const buttonIcon = isCustomButtonIcon ? utils.processFontIcon(props.button_icon) : false;
    const buttonClassName = {
      et_pb_button: true,
      et_pb_custom_button_icon: isCustomButtonIcon,
    };

    return ! utils.hasValue(props.button_text) || ! utils.hasValue(props.button_url) ? '' : (
      <div className='et_pb_button_wrapper'><a
        className={utils.classnames(buttonClassName)}
        href={props.button_url}
        target={buttonTarget}
        rel={utils.linkRel(props.button_rel)}
        data-icon={buttonIcon}
      >{props.button_text}</a></div>
    );
  }

  /**
   * Render prop value. Some attribute values need to be parsed before can be displayed
   *
   * @return mixed
   */
  renderProp(value, fieldName, fieldType, renderSlug) {
    const utils = this.props.utils;
    const _ = utils._;
    const orderClass = `${this.props.moduleInfo.type}_${this.props.moduleInfo.order}`;
    let output = '';

    if (!utils.hasValue(value)) {
      return output;
    }

    const optionSearch = ['&#91;', '&#93;'];
    const optionReplace = ['[', ']'];

    switch(fieldType) {
      case 'options_list':
        value = _.replace(_.replace(value, optionSearch[0], optionReplace[0]), optionSearch[1], optionReplace[1]);
        value = JSON.parse( value );

        if (_.isArray(value)) {
          output = value.map((option, index) => {
            return (
              <option key={`${orderClass}-${index}`} value={option.value}>{option.value}</option>
            );
          });
        }
        break;
      case 'options_list_checkbox':
        const checkboxName = `${orderClass}_${fieldName}`;

        value = _.replace(_.replace(value, optionSearch[0], optionReplace[0]), optionSearch[1], optionReplace[1]);
        value = JSON.parse( value );

        if (_.isArray(value)) {
          output = value.map((option, index) => {
            const checkboxID = `${checkboxName}_${index}`;
            const isChecked = 1 === option.checked;

            return(
              <span className="checkbox-wrap" key={`${orderClass}-${index}`}>
                <input type="checkbox" id={checkboxID} className="input" value={option.value} checked={isChecked} />
                <label htmlFor={checkboxID}><i></i>{option.value}</label>
              </span>
            );
          });
        }
        break;
      case 'options_list_radio':
        value = _.replace(_.replace(value, optionSearch[0], optionReplace[0]), optionSearch[1], optionReplace[1]);
        value = JSON.parse( value );

        const radioName  = `${orderClass}_${fieldName}`;

        if (_.isArray(value)) {
          output = value.map((option, index) => {
            const radioId = `${radioName}_radio_${index}`;
            const isChecked = 1 === option.checked;

            return(
              <span key={`${orderClass}-${index}`} className="radio-wrap">
                <input type="radio" id={radioId} className="input" value={option.value} name={radioName} checked={isChecked} />
                <label htmlFor={radioId}><i></i>{option.value}</label>
              </span>
            );
          });
        }
        break;
      case 'select_fonticon':
        output = (
          <span style={{
            fontFamily: '"ETmodules"',
            fontSize: 40
          }}>{this.props.utils.processFontIcon(value)}</span>
        );
        break;
      case 'upload_image':
        output = <img src={value} alt='' />;
        break;
      default:
        output = value;
        break;
    }

    return output;
  }

  /**
   * Render component output
   *
   * @return object (JSX)
   */
  render() {
    const i10n = window.DiviCustomModulesSettings.i10n.dicm_cta_all_options;
    const props = this.props;

    // Set 3rd party component's css
    this.props.css(this.css());

    return (
      <div>
        <h2 className="dicm-title">{this.props.title}</h2>
        <div className="dicm-content">{this.props.content()}</div>
        {this.renderButton()}
        <div className="basic-fields fields-group">
          <h3>{i10n.basic_fields}</h3>
          <h4>{i10n.text}</h4>
          {props.text}
          <h4>{i10n.textarea}</h4>
          {props.textarea}
          <h4>{i10n.select}</h4>
          {props.select}
          <h4>{i10n.toggle}</h4>
          {props.toggle}
          <h4>{i10n.multiple_buttons}</h4>
          {props.multiple_buttons}
          <h4>{i10n.multiple_checkboxes}</h4>
          {props.multiple_checkboxes}
          <h4>{i10n.input_range}</h4>
          {props.input_range}
          <h4>{i10n.input_datetime}</h4>
          {props.input_datetime}
          <h4>{i10n.input_margin}</h4>
          {props.input_margin}
          <h4>{i10n.checkboxes_category}</h4>
          {props.checkboxes_category}
          <h4>{i10n.select_sidebar}</h4>
          {props.select_sidebar}
        </div>

        <div className="code-fields fields-group">
          <h3>{i10n.code_fields}</h3>
          <h4>{i10n.codemirror}</h4>
          {props.codemirror}
        </div>

        <div className="form-fields fields-group">
          <h3>{i10n.form_fields}</h3>

          <h4>{i10n.option_list}</h4>

            <p>{i10n.prop_value}</p>
            <pre>{props.option_list}</pre>
            <p>{i10n.rendered_prop_value}</p>
            <select name="option-name">
              {this.renderProp(props.options_list, 'options_list', 'options_list', props.moduleInfo.type)}
            </select>

          <h4>{i10n.option_list_checkbox}</h4>
            <p>{i10n.prop_value}</p>
            <pre>{props.options_list_checkbox}</pre>
            <p>{i10n.rendered_prop_value}</p>
            <p>
              {this.renderProp(props.options_list_checkbox, 'options_list_checkbox', 'options_list_checkbox', props.moduleInfo.type)}
            </p>

          <h4>{i10n.option_list_radio}</h4>
            <p>{i10n.prop_value}</p>
            <pre>{props.options_list_radio}</pre>
            <p>{i10n.rendered_prop_value}</p>
            <p>
              {this.renderProp(props.options_list_radio, 'options_list_radio', 'options_list_radio', props.moduleInfo.type)}
            </p>
        </div>

        <div className="typography-fields fields-group">
          <h3>{i10n.typography_fields}</h3>

          <h4>{i10n.select_font_icon}</h4>
            <p>{i10n.prop_value}</p>
            <pre>{props.select_fonticon}</pre>
            <p>{i10n.rendered_prop_value}</p>
            <p>{this.renderProp(props.select_fonticon, 'select_fonticon', 'select_fonticon', props.moduleInfo.type)}</p>

          <h4>{i10n.select_text_align}</h4>
            {props.text_align}

          <h4>{i10n.select_font}</h4>
            {props.select_font}
        </div>

        <div className="color-fields fields-group">
          <h3>{i10n.color_fields}</h3>

          <h4>{i10n.color}</h4>
            {props.color}
            <div className="colorpicker-preview color"></div>

          <h4>{i10n.color_alpha}</h4>
            {props.color_alpha}
            <div className="colorpicker-preview color-alpha"></div>
        </div>

        <div className="upload-fields fields-group">
          <h3>{i10n.upload_fields}</h3>

          <h4>{i10n.upload}</h4>
            <p>{i10n.prop_value}</p>
            <pre>{props.upload}</pre>
            <p>{i10n.rendered_prop_value}</p>
            <p>{this.renderProp(props.upload, 'upload', 'upload_image', props.moduleInfo.type)}</p>
        </div>

        <div className="advanced-fields fields-group">
          <h3>{i10n.advanced_fields}</h3>

          <h4>{i10n.tab_1_text}</h4>
          {props.tab_1_text}

          <h4>{i10n.tab_2_text}</h4>
          {props.tab_2_text}

          <h4>{i10n.presets_shadow}</h4>
          {props.presets_shadow}

          <h4>{i10n.preset_affected_1}</h4>
          {props.preset_affected_1}

          <h4>{i10n.preset_affected_2}</h4>
          {props.preset_affected_2}
        </div>
      </div>
    );
  }
}

export default CustomCtaAllOptions;
