import React, { Component } from 'react';



export default class Slide extends Component {

  render(){




    let oidUpBtn, oidDownBtn,imgTag;
    let btnUpShow = 'hideMe';
    let btnDownShow = 'hideMe';
    if(this.props.slideNum >1){
      btnUpShow='';
      btnDownShow='';
    }

    if(this.props.oid=='1'){
      btnUpShow = 'hideMe';
    }
    if(this.props.oid==this.props.slideNum){
      btnDownShow = 'hideMe';
    }

    if(this.props.slideNum>1){
      oidUpBtn = <button   data-key={this.props.datakey} dx="down" onClick={this.props.changeOided} className={"button up "+btnDownShow}></button>;
    }

    if(this.props.slideNum>1){
      oidDownBtn = <button   data-key={this.props.datakey}  dx="up" onClick={this.props.changeOided}  className={"button down "+btnUpShow}></button>;
    }




    return(
        <div className="slide">
          <div  className="  main">
            <div className="ex1_date">
              {this.props.ex1_date}
            </div>

            <div className="inner-content">
              <div className="header">{this.props.oid}</div>
              <div className="description">
                {this.props.desc} 
              </div>
            </div>
          </div>

          <div className="REST_Controller">
            <button   data-key={this.props.datakey}  slidebox-key={this.props.slideBox}  onClick={this.props.modalopend}  title="Edit" className="button edit">Edit</button>
            <button   slide-key={this.props.datakey} slidebox-key={this.props.slideBox} onClick={this.props.delSlided} title="Del" className="button del">Del</button>
            {oidUpBtn}
            {oidDownBtn}
          </div>
        </div>

    )
  }
}
