// External Dependencies
import React, { Component } from 'react';


class CustomCtaChild extends Component {

  static slug = 'dicm_cta_child';

  _renderButton() {
    const props           = this.props;
    const utils           = window.ET_Builder.API.Utils;
    const buttonTarget    = 'on' === props.url_new_window ? '_blank' : '';
    const buttonIcon      = props.button_icon ? utils.processFontIcon(props.button_icon) : false;
    const buttonClassName = {
      et_pb_button:             true,
      et_pb_custom_button_icon: props.button_icon,
    };

    if (!props.button_text || !props.button_url) {
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
   * Module render in VB
   * Basically DICM_CTA_Child->render() equivalent in JSX
   */
  render() {
    return (
      <div>
        <h2 className="dicm-title">{this.props.title}</h2>
        <h3 className="dicm-subtitle">{this.props.subtitle}</h3>
        <div className="dicm-content">{this.props.content()}</div>
        {this._renderButton()}
      </div>
    );
  }
}

export default CustomCtaChild;
