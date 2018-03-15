// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class CustomCtaFull extends Component {
  hasValue( value ) {
    return '' !== value && typeof value !== 'undefined' && value !== false;
  }

  // WIP
  processFontIcon() {

  }

  // WIP, copied from cta.jsx
  // @todo either replicate utils as method, or find a way to import utils
  renderButton() {
    return '';
    // const attrs = this.props;
    // const buttonTarget = 'on' === attrs.url_new_window ? '_blank' : '';
    // const isCustomButtonIcon = this.hasValue(attrs.button_icon);
    // const buttonIcon = isCustomButtonIcon ? Utils.processFontIcon(attrs.button_icon) : false;
    // const buttonClassName = {
    //   et_pb_promo_button: true,
    //   et_pb_button: true,
    //   et_pb_custom_button_icon: isCustomButtonIcon,
    // };

    // return ! this.hasValue(attrs.button_text) || ! this.hasValue(attrs.button_url) ? '' : (
    //   <div className='et_pb_button_wrapper'><a
    //     className={classnames(buttonClassName)}
    //     href={attrs.button_url}
    //     target={buttonTarget}
    //     rel={this.linkRel('button')}
    //     data-icon={buttonIcon}
    //   >{attrs.button_text}</a></div>
    // );
  }

  render() {
    return (
      <div>
        <h2 className="dicm-title">{this.props.title}</h2>
        <div className="dicm-content">{this.props.content}</div>
        {this.renderButton()}
      </div>
    );
  }
}

export default CustomCtaFull;
