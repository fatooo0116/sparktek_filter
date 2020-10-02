import React, { Component } from 'react';

// import Slide from './Slide';

import SettingField from './SettingField';
import fetchWP from '../../../utils/fetchWP';


export default class SettingFieldOuter extends Component {
    constructor(props){
        super(props);
        this.state = {
          slider_meta:'',           
        }   

        this.fetchWP = new fetchWP({
          restURL: window.wpr_object.api_url,
          restNonce: window.wpr_object.api_nonce,
        });
      }



      componentDidMount(){
        this.initField();
      }





      initField = () =>{
        this.fetchWP.post('slider_meta',{
          tb:this.props.tb,  
        }).then(
          (json) => {
              // me.reLoad();  
              console.log(json);
              this.setState({slider_meta:json.value});        
          },
          (err) => console.log('error', err)
        );
      }





      inputEdit = (column,name) =>{    

        this.fetchWP.put('slider_meta' , {
          tb:this.props.tb,  
          name:name,
          column:column     
        }).then(
          (json) => {
             //  me.reLoad();          
          },
          (err) => console.log('error', err)
        );
         
      }





      render(){


        const {slider_meta} = this.state;        

        console.log(slider_meta);
       
          return(
                <>
                  {(slider_meta)? <SettingField  label='404 文字'       inputEdit={(name) => this.inputEdit('text_404',name) }  value={ slider_meta[0].text_404} /> :''}  
                  {(slider_meta)? <SettingField  label={'搜尋按鈕文字'}    inputEdit={(name) => this.inputEdit('btn_text1',name) }  value={ slider_meta[0].btn_text1} /> :''}
                  {(slider_meta)? <SettingField  label={'重設按鈕文字'}    inputEdit={(name) => this.inputEdit('btn_text2',name) }  value={slider_meta[0].btn_text2} /> :''}
                </>
          )
      }
}