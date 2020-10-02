import React, { Component } from 'react';

// import Slide from './Slide';

import fetchWP from '../../../utils/fetchWP';

import SettingUnit from './SettingUnit';

import SettingFieldOuter from './SettingFieldOuter';


export default class SettingBox extends Component {
  constructor(props){
    super(props);
    this.state = {
      name:'',
      input1:'',    
      input2:'',    
      input3:'',  
      input4:'',      
      input5:'',      
    }

    this.fetchWP = new fetchWP({
      restURL: window.wpr_object.api_url,
      restNonce: window.wpr_object.api_nonce,
    });
  }





  componentDidMount(){
    this.setState({
      name: this.props.sname
    });
  }



/*  ===========================  addType1     ===========================  */
  
  addType1 = () =>{
    let me = this;
    if(this.state.input1==''){
      alert('請輸入考試類型');
      return false;
    }
    
    this.fetchWP.post( 'ex_type', {
      name: me.state.input1, 
      tb:this.props.tb
    })
    .then(
      (json) => {
          me.reLoad();
          me.setState({input1:''});
      },
      (err) => console.log('error', err)
    );  
  }

  /*  ===========================  addType2     ===========================  */

  addType2 = () =>{
    let me = this;
    if(this.state.input2==''){
      alert('請輸入考試組別');
      return false;
    }
    
    this.fetchWP.post( 'ex_type1', {
      name: me.state.input2, 
      tb:this.props.tb
    })
    .then(
      (json) => {
          me.reLoad();
          me.setState({input2:''});
      },
      (err) => console.log('error', err)
    );  
  }
  
  /*  ===========================  addMethod     ===========================  */

  addMethod = () =>{
    let me = this;
    if(this.state.input3==''){
      alert('請輸入聽力測驗形式');
      return false;
    }

    this.fetchWP.post( 'ex1_method', {
      name: me.state.input3,      
      tb:this.props.tb
    })
    .then(
      (json) => {
          me.reLoad();
          me.setState({input3:''});
      },
      (err) => console.log('error', err)
    );     
  }




  /*  ===========================  addStatus     ===========================  */

  addStatus = () =>{
    let me = this;
    if(this.state.input4==''){
      alert('請輸入考試狀態');
      return false;
    }

    this.fetchWP.post( 'ex_status', {
      name: me.state.input4,      
      tb:this.props.tb
    })
    .then(
      (json) => {
          me.reLoad();
          me.setState({input4:''});
      },
      (err) => console.log('error', err)
    );  
  }


    /*  ===========================  addPlace     ===========================  */

    addPlace = () =>{
      let me = this;
      if(this.state.input5==''){
        alert('請輸入考試地點');
        return false;
      }
  
      this.fetchWP.post( 'ex_place', {
        name: me.state.input5,      
        tb:this.props.tb
      })
      .then(
        (json) => {
            me.reLoad();
            me.setState({input5:''});
        },
        (err) => console.log('error', err)
      );  
    }







  delList = (type,id) =>{
    let me = this;
   

    let restDB = '';    
    switch(type){
      case 't1':
        restDB = 'ex_type';
      break;

      case 't2':
        restDB = 'ex_type1';
      break;
      
      case 'm':
        restDB = 'ex1_method';
      break;
      
      case 's':
        restDB = 'ex_status';
      break;   

      case 'p':
        restDB = 'ex_place';
      break;   
    }
    
    
    this.fetchWP.delete(restDB , {
      id:id,           
    }).then(
      (json) => {
          me.reLoad();          
      },
      (err) => console.log('error', err)
    );      
  }





  editList = (new_name,type,id) =>{
    console.log(new_name+' '+type+' '+id);
    
    let me = this;   

    let restDB = '';    
    switch(type){
      case 't1':
        restDB = 'ex_type';
       
      break;

      case 't2':
        restDB = 'ex_type1';
      break;
      
      case 'm':
        restDB = 'ex1_method';
      break;
      
      case 's':
        restDB = 'ex_status';
      break;   

      case 'p':
        restDB = 'ex_place';
      break;   
    }
    
    
    this.fetchWP.put(restDB , {
      id:id,  
      name:new_name,      
    }).then(
      (json) => {
          me.reLoad();          
      },
      (err) => console.log('error', err)
    );      
    
  }









  reLoad = () =>{
    this.props.reload();
  }






   
  render(){


      const { 
        tb,
        ex1_Allmethod,
        ex_Alltype1,
        ex_Alltype2,
        ex_Allstatus,
        ex1_Allplace
       } = this.props; 

       const {
         input1,
         input2,
         input3,
         input4,
         input5,
      } = this.state; 

      const me = this;
       
       // console.log(ex1_Allmethod);
       // console.log(ex1_Allmethod.filter(item => item.tb == tb));

  
      return (
        <div className="setting_box"  >
          <div className="databox">
            <h4>field2</h4>
            
            <ul className="list">
            { 
                ex1_Allplace.filter(item => item.tb == tb).map((sl) =>{
                               return(<SettingUnit  name={sl.pname}  db="p"  key={sl.id}  id={sl.id}  delList={this.delList}  editList={this.editList}  />)
                             // return (<li key={sl.id} ><div className="name">{sl.pname}</div><a href="#" onClick={(e) =>  this.delList(e,'p',sl.id) }>X</a></li>)
                             
                })}    
            </ul>
            <div className="action">
                <input type="text" value={input5} onChange={ (e)=> this.setState({input5:e.target.value }) } />
                <button className="button" onClick={ () => this.addPlace() } >Add</button>
            </div>
          </div>    

          <div className="databox">
            <h4>field3</h4>
            <ul className="list">
            { 
                ex_Alltype1.filter(item => item.tb == tb).map((sl) =>{
                              return(<SettingUnit  name={sl.tname}  db="t1"  key={sl.id}  id={sl.id}  delList={this.delList}  editList={this.editList}  />)
                              // return (<li key={sl.id} ><div className="name">{sl.tname}</div><a href="#" onClick={(e) =>  this.delList(e,'t1',sl.id) }>X</a></li>)
                })}    
            </ul>
            <div className="action">
                <input type="text" value={input1} onChange={ (e)=> this.setState({input1:e.target.value }) } />
                <button className="button" onClick={ () => this.addType1() } >Add</button>
            </div>
          </div>        

          <div className="databox">
            <h4>field4</h4>
            <ul className="list">
            { 
                ex_Alltype2.filter(item => item.tb == tb).map((sl) =>{
                  return(<SettingUnit  name={sl.t1name}  db="t2"  key={sl.id}  id={sl.id}  delList={this.delList}  editList={this.editList}  />)
                  // return (<li key={sl.id} ><div className="name">{sl.tname} {sl.id}</div><a href="#" onClick={(e) =>  this.delList(e,'t2',sl.id) } >X</a></li>)
                })}  
            </ul>
            <div className="action">
                <input type="text" value={input2} onChange={ (e)=> this.setState({input2:e.target.value }) } />
                <button className="button"  onClick={ () => this.addType2() } >Add</button>
            </div>
          </div> 

          <div className="databox">
            <h4>field5</h4>
            <ul className="list">
            { 
                ex1_Allmethod.filter(item => item.tb == tb).map((sl) =>{
                  return(<SettingUnit  name={sl.mname}  db="m"  key={sl.id}  id={sl.id}  delList={this.delList}  editList={this.editList}  />)
                        //      return (<li><div className="name">{sl.mname}</div><a href="#" onClick={(e) =>  this.delList(e,'m',sl.id) }>X</a></li>)
                })}    
            </ul>
            <div className="action">
              <input type="text" value={input3} onChange={ (e)=> this.setState({input3:e.target.value }) } />
                <button className="button" onClick={ () => this.addMethod() } >Add</button>
            </div>
          </div> 


          <div className="databox">
            <h4>field6</h4>
            <ul className="list">
            { 
                ex_Allstatus.filter(item => item.tb == tb).map((sl) =>{
                  return(<SettingUnit  name={sl.sname}  db="s"  key={sl.id}  id={sl.id}  delList={this.delList}  editList={this.editList}  />)
                           //   return (<li key={sl.id} ><div className="name">{sl.sname}</div><a href="#"  onClick={(e) =>  this.delList(e,'s',sl.id) } >X</a></li>)
                })}  
            </ul>
            <div className="action">
                <input type="text" value={input4} onChange={ (e)=> this.setState({input4:e.target.value }) } />
                <button className="button"  onClick={ () => this.addStatus() } >Add</button>
            </div>
          </div> 

          <div className="general_setting fullw">
            <h4>一般設定</h4>
            <SettingFieldOuter   tb={tb} />             
          </div>

        </div>
      )
  }
}
