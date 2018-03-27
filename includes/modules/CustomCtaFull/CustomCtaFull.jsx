// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class CustomCtaFull extends Component {
  renderButton() {
    const attrs = this.props;
    const utils = this.props.utils;
    const buttonTarget = 'on' === attrs.url_new_window ? '_blank' : '';
    const isCustomButtonIcon = utils.hasValue(attrs.button_icon);
    const buttonIcon = isCustomButtonIcon ? utils.processFontIcon(attrs.button_icon) : false;
    const buttonClassName = {
      et_pb_button: true,
      et_pb_custom_button_icon: isCustomButtonIcon,
    };

    return ! utils.hasValue(attrs.button_text) || ! utils.hasValue(attrs.button_url) ? '' : (
      <div className='et_pb_button_wrapper'><a
        className={utils.classnames(buttonClassName)}
        href={attrs.button_url}
        target={buttonTarget}
        rel={utils.linkRel(attrs.button_rel)}
        data-icon={buttonIcon}
      >{attrs.button_text}</a></div>
    );
  }

  /**
   * Module render in VB
   * Basically DICM_CTA_Has_VB_Support->render() equivalent in JSX
   */
  render() {
    return (
      <div>
        <h2 className="dicm-title">{this.props.title}</h2>
        <div className="dicm-content">{this.props.content()}</div>
        {this.renderButton()}
      </div>
    );
  }
}

export default CustomCtaFull;
