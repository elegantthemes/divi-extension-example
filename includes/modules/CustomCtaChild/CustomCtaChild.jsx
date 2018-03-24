// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';

class CustomCtaChild extends Component {
  render() {
    return (
      <div>
        <h2 className="dicm-title">{this.props.title}</h2>
        <div className="dicm-content">{this.props.content}</div>
      </div>
    );
  }
}

export default CustomCtaChild;
