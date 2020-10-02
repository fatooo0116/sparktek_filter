import React, { Component,Fragment } from 'react';
import Slidebox from './Slidebox';
import Modal from 'react-modal';


import fetchWP from '../../utils/fetchWP';

import DatePicker from "react-datepicker";


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


 // Modal.setAppElement(document.getElementById('#wp-reactivate-admin'));


export default class Slideouter extends Component {
  constructor(props){
    super(props);

      this.state = {
        tab_active:0,
        cur_tb:0,
        modalIsOpen: false,
        slider:[],
        modalTitle:'',
        modalDesc:'',
        modalUrl:'',
        
        ex1_location:'',
        ex1_date: new Date(),
        ex1_time:'',
        ex1_img:'',
        ex1_method:'',

        ex2_location:'',
        ex2_date: new Date(),
        ex2_time:'',
        ex2_img:'',
        ex2_method:'',   

        // ex_place:'',
        ex_type1:'',   /* 考試類型  */
        ex_type2:'',  /* 考試組別  */

        ex_result_date:'',
        ex_status: 1,

        uploadFinish:true,
        mediaTarget:'',
        ex_city:'',
        ex_link:'',

        mediaBox:1,

        ex1_Allmethod:[],        
        ex_Alltype1:[],  /* 考試類型  */
        ex_Alltype2:[],  /* 考試組別  */
        ex_Allstatus:[],
        ex1_Allplace:[],

        reload:false
      }

      this.fetchWP = new fetchWP({
        restURL: this.props.wpObject.api_url,
        restNonce: this.props.wpObject.api_nonce,
      });





    this.openModal = this.openModal.bind(this);
    this.afterOpenModal = this.afterOpenModal.bind(this);
    this.closeModal = this.closeModal.bind(this);

    
    this.getExMethodDb = this.getExMethodDb.bind(this);
    this.getExTypeD = this.getExTypeDb.bind(this);
    this.getExType1Db = this.getExType1Db.bind(this);
    this.getExPlaceDb = this.getExPlaceDb.bind(this);

    let me = this;
    wp.media.editor.send.attachment = function(props, attachment){
      
      if(me.state.mediaBox==1){
        me.setState({
          ex1_img:attachment.url
        });
      }else{
        me.setState({
          ex2_img:attachment.url
        });
      }

    }
  }





  componentDidMount(){
    /*  get all slider data */
    this.getAllSlider();
  }



  getAllSlider = () => {

    let me = this;
    this.fetchWP.get( 'myslider' )
    .then(
      (json) => {
         // console.log(json);

          me.getExMethodDb();
          me.getExTypeDb();
          me.getExStatusDb();  
          me.getExPlaceDb();     
          me.getExType1Db();   

          this.setState({
            slider: json.value,
            cur_tb: json.value[me.state.tab_active].id
          });
        },
      (err) => {console.log( 'error', err )}
    );
  };



  getExPlaceDb(){ 
    let me = this;
    this.fetchWP.get('ex_place')
    .then(
      (json) => {
      //  console.log(json);
        
          this.setState({
            ex1_Allplace: json.value,
          });
          
        },
      (err) => console.log( 'error', err ));
  };


  getExMethodDb(){ 
    let me = this;
    this.fetchWP.get('ex1_method')
    .then(
      (json) => {
      //  console.log(json);
        
          this.setState({
            ex1_Allmethod: json.value,
          });
          
        },
      (err) => console.log( 'error', err ));
  };



  getExTypeDb(){
    let me = this;

   // console.log(me.state.cur_tb);
   
    this.fetchWP.get('ex_type')
    .then(
      (json) => {
          
          this.setState({           
            ex_Alltype1: json.value,           
          });
          
        },
      (err) => console.log( 'error', err ));
   };



   getExType1Db(){
    let me = this;

   // console.log(me.state.cur_tb);
   
    this.fetchWP.get('ex_type1')
    .then(
      (json) => {
      
          this.setState({           
            ex_Alltype2: json.value,
          });
          
        },
      (err) => console.log( 'error', err ));
   };



   getExStatusDb(){
    let me = this;
    this.fetchWP.get('ex_status')
    .then(
      (json) => {
        console.log(json);
          
          this.setState({
            ex_Allstatus: json.value,            
          });
          
          
        },
      (err) => console.log( 'error', err ));
   };




  openModal(slide_id,slideBoxId) {

    

    let curState = {... this.state};
    let curSlideBox = curState.slider.filter((e) => e.id === slideBoxId);
    let curSlide = curSlideBox[0].xslide.filter((e) => e.id === slide_id);


     console.log(curSlide);
    
     curState.modalUrl = curSlide[0].url;
     curState.modalTitle = curSlide[0].title;
     curState.modalDesc = curSlide[0].descx;


     curState.ex1_location = curSlide[0].ex1_location;
      curState.ex1_date = (curSlide[0].ex1_date!='0000-00-00')? new Date(curSlide[0].ex1_date) : new Date();
     curState.ex1_time = curSlide[0].ex1_time;
     curState.ex1_img = curSlide[0].ex1_img;
     curState.ex1_method = curSlide[0].ex1_method;
    
     curState.ex2_location = curSlide[0].ex2_location;
      curState.ex2_date = (curSlide[0].ex2_date!='0000-00-00')? new Date(curSlide[0].ex2_date) : new Date();
     curState.ex2_time = curSlide[0].ex2_time;
     curState.ex2_img = curSlide[0].ex2_img;
     curState.ex2_method = curSlide[0].ex2_method;    
     
     curState.ex_type1 = curSlide[0].ex_type1;
     curState.ex_type2 = curSlide[0].ex_type2;

    curState.ex_result_date = (curSlide[0].ex_result_date!='0000-00-00')? new Date(curSlide[0].ex_result_date): new Date();
     curState.ex_status = curSlide[0].ex_status;
     curState.ex_city = curSlide[0].ex_city;
     curState.ex_link = curSlide[0].url;

    curState.modalIsOpen = true;
    curState.modalCurSliderId = slide_id;
    curState.modalCurSliderBoxId = slideBoxId;

    this.setState(curState);

  }

  afterOpenModal() {
    // references are now sync'd and can be accessed.
    // this.subtitle.style.color = '#f00';
  }

  closeModal() {
    this.setState({
      modalCurSliderId:0,
      modalCurSliderBoxId:0,
      modalIsOpen: false
    });
  }















  addSliderBox = () =>{
    // console.log("ADD");

    this.fetchWP.post( 'myslider', {
      name: 'Slider Name' } )
    .then(
      (json) => this.processOkResponse(json, 'saved'),
      (err) => console.log('error', err)
    );
  }






  deleteBox = ( dataKey) => {
    this.fetchWP.delete( 'myslider',{
      'datakey' : dataKey,
    })
    .then(
      (json) => this.processOkResponse(json, 'saved'),
      (err) => console.log('error', err)
    );
  }




  submitBoxNameHandler = (sboxid,Newname) =>{
    console.log("XX");
    this.fetchWP.put( 'myslider',
    { sboxid:sboxid, name: Newname } )
    .then(
      (json) => this.processOkResponse(json, 'saved'),
      (err) => console.log('error', err)
    );
  }



  processOkResponse = (json, action) => {
    if (json.success) {
      console.log(json);
      this.setState({
        slider: json.value,
      });

    } else {
      console.log(`Setting was not ${action}.`, json);
    }
  }




  /* ============= slide =================  */

  addSlideHandler = (slider) =>{

    this.fetchWP.post( 'myslide', {
      slider: slider })
    .then(
      (json) => this.processOkResponse(json, 'saved'),
      (err) => console.log('error', err)
    );
  }


  cloneSlideHandler = (slide,sliderBox) =>{

    // console.log(slide);
    // console.log(sliderBox);

    
    this.fetchWP.post( 'cloneslide', {
      'slide':slide,
      'slider':sliderBox
    })
    .then(
      (json) => this.processOkResponse(json, 'saved'),
      (err) => console.log('error', err)
    );
    
  }



  delSlideHandler = (slide,sliderBox) =>{
    this.fetchWP.delete( 'myslide',{
      'slide':slide,
      'slider':sliderBox
    })
    .then(
      (json) => this.processOkResponse(json, 'saved'),
      (err) => console.log('error', err)
    );
  }

  editSlideHandler = () =>{
  }


  /* =============  Modal Form  ============= */
  formTitlehandle = (event) =>{

    let title = event.target.value;
    this.setState((prevState,props) =>({
      modalTitle : title
    }));
    console.log(this.state);
  }


  formDescehandle = (event) =>{
    let desc = event.target.value;
    this.setState((prevState,props) =>({
      modalDesc : desc
    }));
    console.log(this.state);
  }



  formUrlhandle = (event) =>{
    let url= event.target.value;
    this.setState((prevState,props) =>({
      modalUrl : url
    }));
    console.log(this.state);
  }



  formSubmit  = (e) =>{
    e.preventDefault();
    //console.log("sx");


    let slide_id = this.state.modalCurSliderId;
    let slideBoxId = this.state.modalCurSliderBoxId;

    let curState = [...this.state.slider];
    let curSlideBox = curState.filter((e) => e.id === slideBoxId);
    let curSlide = curSlideBox[0].xslide.filter((e) => e.id === slide_id)[0];
    let modal_form = this.state;

    curSlide.id=curSlide.id;
    curSlide.title=modal_form.modalTitle;
    curSlide.url=modal_form.ex_link;
    curSlide.descx=modal_form.modalDesc;

    curSlide.ex1_location = modal_form.ex1_location;

    let date1 = new Date(modal_form.ex1_date);
    date1 = date1.getFullYear()+'-'+(date1.getMonth()+1)+'-'+date1.getDate();   
    curSlide.ex1_date = date1;

    curSlide.ex1_time = modal_form.ex1_time;
    curSlide.ex1_img = modal_form.ex1_img;
    curSlide.ex1_method = modal_form.ex1_method;

    curSlide.ex2_location = modal_form.ex2_location;

    let date2 = new Date(modal_form.ex2_date);
    date2 = date2.getFullYear()+'-'+(date2.getMonth()+1)+'-'+date2.getDate();   
    curSlide.ex2_date = date2;
    
    curSlide.ex2_time = modal_form.ex2_time;
    curSlide.ex2_img = modal_form.ex2_img;
    curSlide.ex2_method = modal_form.ex2_method;
    
    curSlide.ex_type1 = modal_form.ex_type1;
    curSlide.ex_type2 = modal_form.ex_type2;
    

    let date3 = new Date(modal_form.ex_result_date);
    date3 = date3.getFullYear()+'-'+(date3.getMonth()+1)+'-'+date3.getDate();   
    curSlide.ex_result_date = date3;
   // curSlide.ex_result_date = modal_form.ex_result_date;
    curSlide.ex_status = modal_form.ex_status;
    curSlide.ex_city = modal_form.ex_city

    curSlide.ex_link = modal_form.ex_link



    this.fetchWP.put( 'myslide', {slider: curSlide })
    .then((json) => {
        console.log(json);

        this.closeModal();
        /*
        this.setState((prevState,props) =>({
          slider :curState
        }));
        */
      },
      (err) => console.log('error', err));
  }



  /*  Slide Change oid  */

  changeOidHandler = (e) =>{

  }
  




  medaiUpload = (index) =>{
    console.log("media");
    console.log(window.wp.media);

    this.setState({mediaBox:index});

    window.wp.media.editor.open();
    // wp.media.editor.send.attachment;
  }



  /*   drag adn drop change order ## */
  updateSlideAndSyncDb  = (sliderId,xslide) => {

    let slider = [...this.state.slider];
    console.log(slider);

    let target =0;
    slider.forEach(function(item,i){
      if(item.id ==sliderId){target =i}
    });

    xslide.forEach(function(item,i){
      item.oid = i+1;
    })


   
    slider[target].xslide = xslide;
    // this.setState({slider:slider});


    /*  重新排列 oid 以現有的排列 */
    this.setState({slider:slider});
       
          this.fetchWP.put( 'slideItemOrder', {
           slider:slider[target]
          })
          .then((json) => {
              console.log(json);
    
            },
            (err) => console.log('error', err));               
  }








  SynTableTitleDb = (kid) =>{

    let slider = [...this.state.slider];

    let ix = 0;
    slider.forEach(function(item,i){
      if(item.id==kid){ ix = i; }
    });

    this.fetchWP.post( 'tabletitle', {
      tb1: slider[ix].tb1,
      tb2: slider[ix].tb2,
      tb3: slider[ix].tb3,
      tb4: slider[ix].tb4,
      tb5: slider[ix].tb5,
      tb6: slider[ix].tb6,
      kid:kid  
    })
    .then(
      (json) => {
        this.getAllSlider();
      },
      (err) => console.log('error', err)
    );
  }



  

  
  setTbTitle = (tb, value,kid) =>{

    let me = this;
    let slider = [...this.state.slider];

    //console.log(slider);
    // console.log(kid);

    let ix = 0;
    slider.forEach(function(item,i){
      if(item.id==kid){ ix = i; }
    });
    
    // console.log(slider[ix]);

    switch(tb){
      case 'tb1':
        slider[ix].tb1 = value;
      break;  

      case 'tb2':
        slider[ix].tb2 = value;
      break;  
      case 'tb3':
        slider[ix].tb3 = value;
      break;  
      case 'tb4':
        slider[ix].tb4 = value;
      break;  
      case 'tb5':
        slider[ix].tb5 = value;
      break;  

      case 'tb6':
        slider[ix].tb6 = value;
      break;  

      default:
        me.setState({'slider':slider});
    }

  }



  reloadType = () =>{
    this.getExMethodDb();
    this.getExTypeDb();
    this.getExStatusDb(); 
    this.getExPlaceDb();         
    this.getExType1Db(); 
  }







  render(){

  //  console.log(this.state);

    const { 

      cur_tb,

      ex1_location,
      ex1_date,
      ex1_time,
      ex1_img,
      ex1_method,

      ex2_location,
      ex2_date,
      ex2_time,
      ex2_img,
      ex2_method,        

      ex_type1,
      ex_type2,

      ex_result_date,
      ex_status,
      tab_active,
      slider,
      ex_city,
      ex1_Allmethod,   
      ex_Alltype1,
      ex_Alltype2,
      ex1_Allplace,
      ex_Allstatus,
      ex_link   
    }  = this.state;

 



      return (
        <Fragment>
        <div   className="app-header">         
          <div><h3>考試日期設定</h3></div>
        </div>
        <div  className="slideBox">

          <div className="tabs">
            { 
              slider.map(( item, i) =>{
                return (<div className={(tab_active==i)? 'tab active':'tab'}  onClick={()=>{ this.setState({
                          tab_active:i,
                          cur_tb:slider[i].id
                        }) 
                      }} >{ item.name }</div>) 
              })
            }            
          </div>








          <div className="inner">
            {
              this.state.slider.map((sl,i) =>
                (i == tab_active)?
                <li key={sl.id.toString()}  >
                  <Slidebox
                      key={sl.id}
                      sname={sl.name}
                      tb1={sl.tb1}
                      tb2={sl.tb2}
                      tb3={sl.tb3}
                      tb4={sl.tb4}
                      tb5={sl.tb5}
                      tb6={sl.tb6}
                      kid={sl.id.toString()}
                      slideData={sl.xslide}
                      deleteBox={ this.deleteBox }
                      addSlide={this.addSlideHandler}
                      delSlide={this.delSlideHandler}
                      cloneSlide = {this.cloneSlideHandler}
                      submitBoxNamed={this.submitBoxNameHandler}
                      openModaled={this.openModal}
                      changeOided={this.changeOidHandler}
                      updateSlideAndSyncDb = {this.updateSlideAndSyncDb}
                      ex1_Allmethod = {ex1_Allmethod}
                      ex_Alltype1 ={ex_Alltype1}    
                      ex_Alltype2 ={ex_Alltype2} 
                      ex_Allstatus = {ex_Allstatus}
                      ex1_Allplace={ex1_Allplace}

                      SynTableTitleDb = {this.SynTableTitleDb}           
                      setTbTitle = {this.setTbTitle}
                      reload = {this.reloadType }
                      />
                </li>:''
              )
            }
          </div>





          <button className="button btnAdd" onClick={this.addSliderBox}>新增列表</button>

          


        {/*  ==============================   Modal  ==============================   */}
              <Modal
                    id="edit_box"
                    isOpen={this.state.modalIsOpen}
                    onAfterOpen={this.afterOpenModal}
                    onRequestClose={this.closeModal}
                    style={customStyles}
                    contentLabel="Example Modal"
                  >

                    <button onClick={this.closeModal}  className="model_exit">close</button>



                    <form onSubmit={this.formSubmit}>
                      <div className="input-form">
                        <label className="tl">考試地區</label>                                             
                          <select value={ex_city} onChange={(e)=> this.setState({ex_city:e.target.value}) } >                          
                            <option  value="" >請選擇</option> 
                            {ex1_Allplace.filter(item => (item.tb == cur_tb)).map((sl) =>{
                              return (<option  value={sl.id} >{sl.pname}</option>)
                            })}                           
                          </select>
                      </div>



                    <div className="w45">
                        <div className="input-form">
                          <label className="tl" >考試時間</label>
                          <DatePicker dateFormat="Y-M-d"  selected={ex1_date} onChange={(date)=> this.setState({ex1_date:date}) } onSelect={(date)=>  {  this.setState({ex1_date:date}); }}   className="full" />                         
                        </div>

                        <div className="input-form">
                          <label className="tl" >考試備註(選填)</label>
                          <input type="text"  value={ex1_time} onChange={(e)=> this.setState({ex1_time:e.target.value}) } />
                        </div>  

                        <div className="input-form">
                          <label className="tl" >考試考場</label>
                          <input type="text"  value={ex1_location} onChange={(e)=> this.setState({ex1_location:e.target.value}) } /> 
                        </div>  



                        <div className="input-form">
                          <label className="tl">考試模式</label>                       
                          <select value={ex1_method} onChange={(e)=> this.setState({ex1_method:e.target.value}) } >                          
                            <option  value="" >請選擇</option> 
                            {ex1_Allmethod.filter(item => (item.tb == cur_tb)).map((sl) =>{
                              return (<option  value={sl.id} >{sl.mname}</option>)
                            })}                           
                          </select>
                        </div>

                        
                        
                        <div className="input-form">
                              <div className="slider_image"></div>
                              <input type="text"  name="url"  className="full"  value={ex1_img} onChange={(e)=> this.setState({ex1_img:e.target.value}) }  />
                              <button  type="button" className="button" onClick={() => this.medaiUpload(1)}>upload</button>
                        </div>                        
                    </div>

                    <div className="w45" style={{display:'none'}} >
                          <div className="input-form">
                            <label className="tl">口試日期</label>
                            <DatePicker dateFormat="Y-M-d"  selected={ex2_date} onChange={(date)=> this.setState({ex2_date:date}) } onSelect={(date)=>  { this.setState({ex2_date:date}); }}   className="full" />     
                          </div>

                          <div className="input-form">
                            <label className="tl">口試時間</label>
                            <input type="text"  value={ex2_time} onChange={(e)=> this.setState({ex2_time:e.target.value}) }   />
                          </div>  

                          <div className="input-form">
                            <label className="tl">口試考場</label>
                            <input type="text"  value={ex2_location} onChange={(e)=> this.setState({ex2_location:e.target.value}) }   />
                          </div>  
                          
                          <div className="input-form">
                                <div className="slider_image"></div>
                                <input type="text"  name="url"  className="full"  value={ex2_img} onChange={(e)=> this.setState({ex2_img:e.target.value}) }   />
                                <button  type="button" className="button" onClick={() => this.medaiUpload(2)}>upload</button>
                          </div>                        
                      </div>   

                      <div className="input-form">
                        <hr/>
                      </div>


                      <div className="input-form">
                        <label className="tl">考試類型</label>                       
                        <select value={ex_type1} onChange={(e)=> this.setState({ex_type1:e.target.value}) } >
                        <option  value="" >請選擇</option> 
                          {ex_Alltype1.filter(item => item.tb == cur_tb).map((sl) =>{
                              return (<option  value={sl.id} >{sl.tname}</option>)
                            })}                                                     
                        </select>
                      </div>

                      <div className="input-form">
                        <label className="tl">考試組別</label>                       
                        <select value={ex_type2} onChange={(e)=> this.setState({ex_type2:e.target.value}) } >
                        <option  value="" >請選擇</option> 
                          {ex_Alltype2.filter(item => item.tb == cur_tb).map((sl) =>{
                              return (<option  value={sl.id} >{sl.t1name}</option>)
                            })}                                                     
                        </select>
                      </div>


                      <div className="input-form" style={{display:'none'}}>
                        <label className="tl">成績單核發日期</label>
                        <DatePicker dateFormat="Y-M-d"  selected={ex_result_date} onChange={(date)=> this.setState({ex_result_date:date}) } onSelect={(date)=>  { this.setState({ex_result_date:date}); }}   className="full" />                             
                      </div>  
                                         
                      <div className="input-form">
                        <label className="tl">報名狀態</label>                       
                        <select value={ex_status} onChange={(e) => this.setState({ex_status:e.target.value})}> 
                          <option  value="" >請選擇</option>            
                          {ex_Allstatus.filter(item => item.tb == cur_tb).map((sl) =>{
                              return (<option  value={sl.id} >{sl.sname}</option>)
                            })}                     
                        </select>
                      </div>

                      <div className="input-form">
                            <label className="tl">報名連結</label>
                            <input type="text"  style={{width:'80%'}} value={ex_link} onChange={(e)=> this.setState({ex_link:e.target.value}) } /> 
                      </div>


                    
                      <div className="input-form" style={{display:'none'}}>
                        <input type="text" onChange={this.formTitlehandle} value={this.state.modalTitle}   />
                      </div>
                     
                      <div className="input-form" style={{display:'none'}}>
                        <textarea  onChange={this.formDescehandle} value={this.state.modalDesc}  />
                      </div>
                      
                      <div className="input-form center">
                        <input type="submit" className="button "  value="Submit" />
                      </div>
                    </form>
                  </Modal>


        </div>
      </Fragment>
      )
  }
}
