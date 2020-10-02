import React, { Component } from 'react';

// import Slide from './Slide';

// import fetchWP from '../../../utils/fetchWP';


export default class SettingField  extends Component {
    constructor(props){
        super(props);
        this.state = {
            name:'',    
            is_edit: false     
        }
      }


      componentDidMount(){
        let me = this;
        this.setState({name: me.props.value});
       console.log(me.props.value);
      }


      inputOnChange = (e) =>{
        this.setState({name:e.target.value});
      }



      inputOnBlur = () =>{      
        let me =this;
        setTimeout(function(){
          me.setState({
            is_edit: false,            
           });
        },200);
      } 


      startEditInput = () =>{
        this.setState({
                     is_edit: true,                      
                    });                
      }


      inputEdit = (name) =>{
        this.props.inputEdit(name);
      }



      render(){
         const {                                 
                label                                  
                } = this.props;

        const {name,is_edit} = this.state;        

          return(
                <div  className="setting_field">                    
                    {<div className="name" >
                                <div className="mylabel">{label}</div>
                                <input   type="text" value={name}    onChange={(e)=> this.inputOnChange(e)}  onFocus={this.startEditInput} onBlur={this.inputOnBlur} />
                                {(is_edit)? <button className="edit_btn" onClick={() => this.inputEdit(name) }>Save</button> :''}                                                             
                    </div>}                    
                </div>
          )
      }
}