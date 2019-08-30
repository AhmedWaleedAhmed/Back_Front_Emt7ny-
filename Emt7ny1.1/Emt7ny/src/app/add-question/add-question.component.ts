import { Component, OnInit } from '@angular/core';
import { AuthService } from '../Services/auth.service';
import {  Router } from '@angular/router';
import { TokenService } from '../Services/token.service';

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


  constructor(
    private router: Router ,
    private Auth: AuthService,
    private token:TokenService,
  ) {
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

  logout(event : MouseEvent){
    event.preventDefault();
    this.token.remove();
    this.Auth.changeAuthStatus(false);
    this.router.navigateByUrl('');
  }


}
