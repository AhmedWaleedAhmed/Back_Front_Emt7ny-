import { Component, OnInit } from '@angular/core';
import { AuthService } from '../Services/auth.service';
import {  Router } from '@angular/router';
import { TokenService } from '../Services/token.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  uploadedImg = null;
  pp: string = '../../assets/img/grey.png';
  reader: FileReader = new FileReader();

  constructor(
    private router: Router ,
    private Auth: AuthService,
    private token:TokenService,
  ) { }

  ngOnInit() {
  }

  processImage(event) {
    this.uploadedImg = event.target.files[0];
    this.reader.onload = (event: any) => {
      this.pp = event.target.result;
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
