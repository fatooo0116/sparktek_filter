import React, { Component } from 'react';

// import Slide from './Slide';

import fetchWP from '../../utils/fetchWP';

import Modal from 'react-modal';

import SettingBox from './setting/SettingBox';


import {sortableContainer, sortableElement} from 'react-sortable-hoc';
import arrayMove from 'array-move';


const customStyles = {
  content : {
    top                   : '50%',
    left                  : '50%',
    right                 : 'auto',
    bottom                : 'auto',
    marginRight           : '-50%',
    transform             : 'translate(-50%, -50%)'
  }
};



export default class Slidebox extends Component {
  constructor(props){
    super(props);
    this.state = {
      name:'',
      isEdit:false,


      isEdit_t1:false,
      isEdit_t2:false,
      isEdit_t3:false,
      isEdit_t4:false,
      isEdit_t5:false,
      isEdit_t6:false,

      modal1IsOpen:false,
      modal2IsOpen:false,
      modal3IsOpen:false,
      
      
      settingBox:false, /*  設定面板 */
    }
  }






  componentDidMount(){
    this.setState({
      name: this.props.sname
    });
  }












  toggleEditName = () => {
    this.setState({
      isEdit: !this.state.isEdit
    });
  }

  updateSliderBoxName = () => {
    this.setState({
      name: event.target.value
    });
  }

  submitBoxName = () =>{
    this.props.submitBoxNamed(this.props.kid,this.state.name);
    this.toggleEditName();
  }
  




  deleteSliderBox = (e) => {
    if(window.confirm('確定全部刪除？')){
      let datakey = e.target.getAttribute('data-key');
      this.props.deleteBox( datakey);
    }
  }


  addSlide = (e) =>{
    this.props.addSlide(e.target.getAttribute('data-key'));
  }


  cloneSlide = (slidekey,slideboxkey) => {          
      this.props.cloneSlide(slidekey,slideboxkey);    
  }


  delSlide = (e) =>{
    // console.log(e.target.getAttribute('slide-key'));
    if(window.confirm('確定刪除？')){
      let slideboxkey = e.target.getAttribute('slidebox-key');
      let slidekey = e.target.getAttribute('slide-key')
      this.props.delSlide(slidekey,slideboxkey);
    }
  }


  modalOpen = (e) =>{
    this.props.openModaled(e.target.getAttribute('data-key'),e.target.getAttribute('slidebox-key'));
  }





  onSortEnd = ({oldIndex, newIndex}) => {
    let xslide = [...this.props.slideData];
    xslide = arrayMove(xslide, oldIndex, newIndex),        
    this.props.updateSlideAndSyncDb( this.props.slideData[oldIndex].slider,xslide);      
   };  





  



















  SynTableTitleDb = () =>{
    this.props.SynTableTitleDb(
      this.props.kid
    );
    this.setState({
      isEdit_t1:false,
      isEdit_t2:false,
      isEdit_t3:false,
      isEdit_t4:false,
      isEdit_t5:false,
      isEdit_t6:false,
    });
  }



   
  render(){

  const me = this;
  const {
         tb1,tb2,tb3,tb4,tb5,tb6,
         ex_status,
         kid,
         ex1_Allmethod,
         ex1_Allplace,
         ex_Alltype1,
         ex_Alltype2,
         ex_Allstatus
        }  = this.props;


 const {settingBox}  = this.state;



  {/*
      ex1_method   聽力測驗方式
      ex_Alltype1  考試類型
      ex_Alltype2  考試組別
  */}


  const SortableItem = sortableElement(({value,index}) =>     
      <li key={`item-${value.id}`} index={index} className="slide" > 
          <div  className="  main">
              <div className="sec1">
               {value.ex1_date}<br/>{value.ex1_time}
              </div>        
              <div className="sec2">
                {value.ex1_location} - {(ex1_Allplace.filter(item => item.id == value.ex_city ).length > 0 & value.ex_city>0)? ex1_Allplace.filter(item => item.id == value.ex_city )[0].pname :''}
              </div>     
              <div className="sec3">
                {/* 考試類型 */}
                { (ex_Alltype1.filter(item => item.id == value.ex_type1).length > 0 & value.ex_type1>0)? ex_Alltype1.filter(item => item.id == value.ex_type1 )[0].tname : ''}   
                { /* value.ex_type1 */}                                        
              </div>
              <div className="sec4">
                { /* 考試組別 */}
                { (ex_Alltype2.filter(item => item.id == value.ex_type2 ).length > 0 & value.ex_type2>0)? ex_Alltype2.filter(item => item.id == value.ex_type2 )[0].t1name : ''}   
                {/* value.ex_type2 */}                            
              </div>
              <div className="sec4">
                  {/* 聽力測驗方式  */}                  
                  { (ex1_Allmethod.filter(item => item.id == value.ex1_method ).length > 0 & value.ex1_method>0)? ex1_Allmethod.filter(item => item.id == value.ex1_method )[0].mname : ''}                  
              </div>    
              <div className="sec1">
                { (ex_Allstatus.filter(item => item.id == value.ex_status ).length > 0 & value.ex_status>0)? ex_Allstatus.filter(item => item.id == value.ex_status )[0].sname : ''} 
                  {/* value.ex_status */}
              </div>          

          </div>
        <div className="REST_Controller">          
                  <button   data-key={value.id}  slidebox-key={this.props.kid}  onClick={() =>  this.cloneSlide(value.id ,this.props.kid) }  title="Clone" className="button clone">Clone</button>
                  <button   data-key={value.id}  slidebox-key={this.props.kid}  onClick={this.modalOpen}  title="Edit" className="button edit">Edit</button>
                  <button   slide-key={value.id} slidebox-key={this.props.kid} onClick={this.delSlide} title="Del" className="button del">Del</button>
        </div>
        </li>);






  const SortableContainer = sortableContainer(({children}) => {
    return <ul>{children}</ul>;
  });



   const slideData =   this.props.slideData;
    slideData.sort(function(a, b) {
     return a.oid - b.oid;
    });

     // console.log(settingBox);

      let SliderName = this.state.isEdit ? <label><input type="text" onChange={this.updateSliderBoxName}  defaultValue={this.state.name} /><button  className="button" onClick={this.submitBoxName} >Save</button></label> : <label  onClick={this.toggleEditName}>{this.state.name}</label>;
      let SliderName2 = <label  ><input type="text" value={'[exam_table id="'+this.props.kid+'" ]'}  /></label>;

      return (
        <div className="slide-inner-box"  onClick={this.props.onclicked} >
          <div  className="slide_controller">
            <button className="button del"  data-key={this.props.kid}  onClick={this.deleteSliderBox} > 刪除整個表單 </button>
            <button className="button" data-key={this.props.kid} onClick={this.addSlide}> 新增資料 </button>

            <button className="button" data-key={this.props.kid}  onClick={ ()=> { this.setState({settingBox : !settingBox }) }} > 設定 </button>
            

            <div className="meta_name">
              <span>{SliderName}</span>
              <span>{SliderName2}</span>
            </div>
          </div>





         { /*    設定設定考試類型 考試組別 考試狀態 聽力測驗形式  */ }
          {(settingBox) ?<SettingBox  
              tb={kid}   
              ex1_Allmethod = {ex1_Allmethod}
              ex_Alltype1 ={ex_Alltype1}    
              ex_Alltype2 ={ex_Alltype2} 
              ex1_Allplace={ex1_Allplace}
              ex_Allstatus = {ex_Allstatus}
              reload = {this.props.reload}
           /> : ''}
        



          <div  className="content">
              <div className="head main">
                <div className="sec1"> 
                  { (this.state.isEdit_t1)? 
                    <label>
                          <input type="text"  onChange={(e) => this.props.setTbTitle('tb1',e.target.value,this.props.kid)}   defaultValue={(!tb1)?'筆試':tb1} />
                          <button  className="button" onClick={this.SynTableTitleDb} >Save</button>
                    </label>
                    : <label  onClick={()=> this.setState({ isEdit_t1: true})}>{(!tb1)? '筆試': tb1}</label> }
                </div>

                <div className="sec2">
                { (this.state.isEdit_t2)? 
                    <label>
                          <input type="text" onChange={(e) => this.props.setTbTitle('tb2',e.target.value,this.props.kid)}  defaultValue={(!tb2)?'口試':tb2} />
                          <button  className="button" onClick={this.SynTableTitleDb} >Save</button>
                    </label>
                    : <label  onClick={()=> this.setState({ isEdit_t2: true})}>{(!tb2)? '口試': tb2}</label> }
                </div>

                <div className="sec3">
                { (this.state.isEdit_t3)? 
                    <label>
                          <input type="text" onChange={(e) => this.props.setTbTitle('tb3',e.target.value,this.props.kid)}  defaultValue={(!tb3)?'地點':tb3} />
                          <button  className="button" onClick={this.SynTableTitleDb} >Save</button>
                    </label>
                    : <label  onClick={()=> this.setState({ isEdit_t3: true})}>{(!tb3)? '地點': tb3}</label> }
                </div>

                <div className="sec4">
                { (this.state.isEdit_t4)? 
                    <label>
                          <input type="text" onChange={(e) => this.props.setTbTitle('tb4',e.target.value,this.props.kid)}  defaultValue={(!tb4)?'考試組別':tb4} />
                          <button  className="button" onClick={this.SynTableTitleDb} >Save</button>
                    </label>
                    : <label  onClick={()=> this.setState({ isEdit_t4: true})}>{(!tb4)? '考試組別': tb4}</label> }
                </div>


                <div className="sec4">
                { (this.state.isEdit_t6)? 
                    <label>
                          <input type="text" onChange={(e) => this.props.setTbTitle('tb6',e.target.value,this.props.kid)}  defaultValue={(!tb6)?'聽力測驗形式':tb4} />
                          <button  className="button" onClick={this.SynTableTitleDb} >Save</button>
                    </label>
                    : <label  onClick={()=> this.setState({ isEdit_t6: true})}>{(!tb6)? '聽力測驗形式': tb6}</label> }
                </div>


                
                <div className="sec1">
                  { (this.state.isEdit_t5)? 
                      <label>
                            <input type="text" onChange={(e) => this.props.setTbTitle('tb5',e.target.value,this.props.kid)}  defaultValue={(!tb5)?'狀態':tb5} />
                            <button  className="button" onClick={this.SynTableTitleDb} >Save</button>
                      </label>
                      : <label  onClick={()=> this.setState({ isEdit_t5: true})}>{(!tb5)? '狀態': tb5}</label> }            
                </div>
              </div>


            {/*  ===============   Table  Date  List  ==================  */}
            <SortableContainer onSortEnd={this.onSortEnd}>
            {slideData.map((value, index) => (

            

              <SortableItem key={`item-${value.id}`} index={index} value={value} />
            ))}
        </SortableContainer>


            <div className="footer_nav">
              <button className="button" data-key={this.props.kid} onClick={this.addSlide}> 新增資料 </button>
            </div>            
          </div>






        </div>
      )
  }
}
