import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-add-question',
  templateUrl: './add-question.component.html',
  styleUrls: ['./add-question.component.css']
})
export class AddQuestionComponent implements OnInit {

  uploadedImg = null;
  reader: FileReader = new FileReader();
  imgUrl = '../../assets/img/grey.png';
  /**
   * Answer type
   */
  answer:string = null;

  constructor() {
    window.scroll(0, 0);
   }

  ngOnInit() {
  }

  processImage(event) {
    this.uploadedImg = event.target.files[0];
    this.reader.onload = (event: any) => {
      this.imgUrl = event.target.result;
      console.log(event.loaded / event.total * 100 + '%');
    };
    this.reader.readAsDataURL(this.uploadedImg);
  }


}
