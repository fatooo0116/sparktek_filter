import React, { Component } from 'react';

// import Slide from './Slide';



export default class SettingUnit extends Component {
    constructor(props){
        super(props);
        this.state = {
            local_name:'',
            is_edit:false
        }
      }



      delListLocal = (e,id) =>{
        e.preventDefault();
        this.props.delList(this.props.db,id)
      }


      inputOnChange = (e) =>{
        this.setState({local_name:e.target.value});
      }

      inputOnBlur = () =>{
          // alert('blur');
          this.setState({
            is_edit: !this.state.is_edit,
             local_name:''
           });
      } 

      startEditInput = (e,name) =>{
        this.setState({
                     is_edit: !this.state.is_edit,
                      local_name:name
                    });                
      }


      inputEdit = () =>{
        this.props.editList(
            this.state.local_name,
            this.props.db,
            this.props.id);
        
            this.setState({
                is_edit: !this.state.is_edit
            });    
      }





      render(){
         const { 
                id,
                name,                           
                } = this.props;

        const {is_edit,local_name} = this.state;        

          return(
                <li key={id}>                    
                {(is_edit) ? <div className="name" >
                                <input  ref={(input) => { this.textInput = input; }}  type="text" value={local_name}    onChange={(e)=> this.inputOnChange(e)} />
                                <button className="edit_btn" onClick={this.inputEdit}>Edit</button>
                                <button  onClick={(e) =>  this.delListLocal(e,id) } > Del</button>
                                <button  onClick={this.inputOnBlur} className="exit_btn">Exit</button>
                            </div> :
                             <div className="name" onClick={(e)=> this.startEditInput(e,name) }>{name}</div>}                    
                </li>
          )
      }
}