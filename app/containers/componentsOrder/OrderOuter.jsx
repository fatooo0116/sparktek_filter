import React, { Component,Fragment } from 'react';
// import Slidebox from './Slidebox';

import {sortableContainer, sortableElement} from 'react-sortable-hoc';

import fetchWP from '../../utils/fetchWP';
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


 // Modal.setAppElement(document.getElementById('#wp-reactivate-admin'));


export default class OrderOuter extends Component {
  constructor(props){
    super(props);

      this.state = {
        tab_active:0,
        modalIsOpen: false,
        allpost:[],
 
      }

      this.fetchWP = new fetchWP({
        restURL: this.props.wpObject.api_url,
        restNonce: this.props.wpObject.api_nonce,
      });


      this.getPostDb = this.getPostDb.bind(this);
  }


  componentDidMount(){
    this.getPostDb();
  }


  getPostDb(){ 
    this.fetchWP.get(this.props.post)
    .then(
      (json) => {
        console.log(json);
        
          this.setState({
            allpost: json.value,
          });
          
        },
      (err) => console.log( 'error', err ));
  };



  onSortEnd = ({oldIndex, newIndex}) => {
    let allpost = [...this.state.allpost];
 
    allpost = arrayMove(allpost, oldIndex, newIndex),
    allpost.forEach(function(item,i){
      item.oid = i
    });
     
    this.setState({allpost:allpost});
    // this.props.updateSlideAndSyncDb( this.props.slideData[oldIndex].slider,xslide);      
    this.SyncDb(allpost);
   };  





   SyncDb = (allpost) =>{
     console.log(allpost);
    console.log('Sync');

    this.fetchWP.put( this.props.post,
    { allpost: allpost } )
    .then(
      (json) => {
        console.log(json);
      },
      (err) => console.log('error', err)
    );

   }




  render(){

    const {allpost } =  this.state;

    allpost.sort(function(a, b) {
      return a.oid - b.oid;
    });
    

    console.log(allpost);


    

    const SortableItem = sortableElement(({value,index}) => <li key={`item-${value.id}`} index={index} className="slide"  pid={value.ID}  className="slide"  > <span className="hideme">{value.oid}</span>
                                                                  <a href={value.guid} target="_blank"  className="post_link"  >{value.term_name} - {value.post_title}</a></li>);

    const SortableContainer = sortableContainer(({children}) => {
      return <ul>{children}</ul>;
    });

      return (
        <Fragment>
            <div>
                
            <SortableContainer onSortEnd={this.onSortEnd}>
              {allpost.map((value, index) => (
                <SortableItem key={`item-${value.id}`} index={index} value={value} />
              ))}
            </SortableContainer>

            </div>
      </Fragment>
      )
  }
}
