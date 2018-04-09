// External Dependencies
import React, { Component } from 'react';


class CustomCtaAllOptions extends Component {

  static slug = 'dicm_cta_all_options';

  /**
   * All component inline styling.
   *
   * @since 1.0.0
   *
   * @return array
   */
  static css(props) {
    const utils         = window.ET_Builder.API.Utils;
    const additionalCss = [];

    // Process text-align value into style
    if (props.text_align) {
      additionalCss.push([{
        selector:    '%%order_class%% .typography-fields',
        declaration: `text-align: ${props.text_align};`,
      }]);
    }

    // Process font option into style
    if (props.select_font) {
      additionalCss.push([{
        selector:    '%%order_class%% .typography-fields',
        declaration: utils.setElementFont(props.select_font),
      }]);
    }

    // Process color preview color
    if (props.color) {
      additionalCss.push([{
        selector:    '%%order_class%% .colorpicker-preview.color',
        declaration: `background-color: ${props.color};`,
      }]);
    }

    // Process color preview color alpha
    if (props.color_alpha) {
      additionalCss.push([{
        selector:    '%%order_class%% .colorpicker-preview.color-alpha',
        declaration: `background-color: ${props.color_alpha};`,
      }]);
    }

    return additionalCss;
  }

  /**
   * Custom method to render button UI
   *
   * @return {string|React.Component}
   */
  _renderButton() {
    const props              = this.props;
    const utils              = window.ET_Builder.API.Utils;
    const buttonTarget       = 'on' === props.url_new_window ? '_blank' : '';
    const buttonIcon         = props.button_icon ? utils.processFontIcon(props.button_icon) : false;
    const buttonClassName    = {
      et_pb_button:             true,
      et_pb_custom_button_icon: props.button_icon,
    };

    if (! props.button_text || ! props.button_url) {
      return '';
    }

    return (
      <div className='et_pb_button_wrapper'>
        <a
          className={utils.classnames(buttonClassName)}
          href={props.button_url}
          target={buttonTarget}
          rel={utils.linkRel(props.button_rel)}
          data-icon={buttonIcon}
        >
          {props.button_text}
        </a>
      </div>
    );
  }

  /**
   * Render prop value. Some attribute values need to be parsed before can be displayed
   *
   * @return {string|React.Component|React.component[]}
   */
  _renderProp(value, fieldName, fieldType, renderSlug) {
    const utils      = window.ET_Builder.API.Utils;
    const _          = utils._;
    const orderClass = `${this.props.moduleInfo.type}_${this.props.moduleInfo.order}`;

    let output = '';

    if (! value) {
      return output;
    }

    switch (fieldType) {
      case 'options_list':
        value = utils.decodeOptionListValue(value);

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

        value = utils.decodeOptionListValue(value);

        if (_.isArray(value)) {
          output = value.map((option, index) => {
            const checkboxID = `${checkboxName}_${index}`;
            const isChecked  = 1 === option.checked;

            return (
              <span className="checkbox-wrap" key={`${orderClass}-${index}`}>
                <input type="checkbox" id={checkboxID} className="input" value={option.value} readOnly={true} checked={isChecked}/>
                <label htmlFor={checkboxID}><i></i>{option.value}</label>
              </span>
            );
          });
        }
        break;
      case 'options_list_radio':
        const radioName = `${orderClass}_${fieldName}`;

        value = utils.decodeOptionListValue(value);

        if (_.isArray(value)) {
          output = value.map((option, index) => {
            const radioId   = `${radioName}_radio_${index}`;
            const isChecked = 1 === option.checked;

            return (
              <span key={`${orderClass}-${index}`} className="radio-wrap">
                <input type="radio" id={radioId} className="input" value={option.value} name={radioName} readOnly={true} checked={isChecked}/>
                <label htmlFor={radioId}><i></i>{option.value}</label>
              </span>
            );
          });
        }
        break;
      case 'select_fonticon':
        output = (
          <span style={{fontFamily: '"ETmodules"', fontSize: 40}}>{utils.processFontIcon(value)}</span>
        );
        break;
      case 'upload_image':
        output = <img src={value} alt=''/>;
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
   * @return {string|React.Component|React.component[]}
   */
  render() {
    const i10n  = window.DiviCustomModulesBuilderData.i10n.dicm_cta_all_options;
    const props = this.props;

    return (
      <div>
        <h2 className="dicm-title">{this.props.title}</h2>
        <div className="dicm-content">{this.props.content()}</div>
        {this._renderButton()}
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
            {this._renderProp(props.options_list, 'options_list', 'options_list', props.moduleInfo.type)}
          </select>

          <h4>{i10n.option_list_checkbox}</h4>
          <p>{i10n.prop_value}</p>
          <pre>{props.options_list_checkbox}</pre>
          <p>{i10n.rendered_prop_value}</p>
          <p>
            {this._renderProp(props.options_list_checkbox, 'options_list_checkbox', 'options_list_checkbox', props.moduleInfo.type)}
          </p>

          <h4>{i10n.option_list_radio}</h4>
          <p>{i10n.prop_value}</p>
          <pre>{props.options_list_radio}</pre>
          <p>{i10n.rendered_prop_value}</p>
          <p>
            {this._renderProp(props.options_list_radio, 'options_list_radio', 'options_list_radio', props.moduleInfo.type)}
          </p>
        </div>

        <div className="typography-fields fields-group">
          <h3>{i10n.typography_fields}</h3>

          <h4>{i10n.select_font_icon}</h4>
          <p>{i10n.prop_value}</p>
          <pre>{props.select_fonticon}</pre>
          <p>{i10n.rendered_prop_value}</p>
          <p>{this._renderProp(props.select_fonticon, 'select_fonticon', 'select_fonticon', props.moduleInfo.type)}</p>

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
          <p>{this._renderProp(props.upload, 'upload', 'upload_image', props.moduleInfo.type)}</p>
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
