import React, { Component } from 'react';
import PropTypes from 'prop-types';


import SliderOuter from './components/Sliderouter';

import OrderOuter from './componentsOrder/OrderOuter';




export default class Admin extends Component {
  constructor(props) {
    super(props);

    this.state = {
      exampleSetting: '',
      savedExampleSetting: '',
      slider:[],
      tab:0
    };

  }



  render() {

    const {tab} = this.state

    return (
      <div id="sliderDom" className="wrap">
        <div className="slideBox">            
          <div className="tab_content">
            <SliderOuter wpObject={window.wpr_object}   />
          </div>
        </div>
      </div>
    );
  }
}

Admin.propTypes = {
  wpObject: PropTypes.object
};
