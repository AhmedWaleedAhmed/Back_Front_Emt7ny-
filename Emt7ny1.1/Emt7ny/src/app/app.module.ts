import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import {FormsModule} from '@angular/forms'; 
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { AddQuestionComponent } from './add-question/add-question.component';
import { PreviewComponent } from './preview/preview.component';
import { ProfileComponent } from './profile/profile.component';
import {HttpClientModule} from '@angular/common/http';
import { CorrectExamComponent } from './correct-exam/correct-exam.component';
import { CorrectListComponent } from './correct-list/correct-list.component';
import { EditProfileComponent } from './edit-profile/edit-profile.component';
import { SignaturePadModule } from 'angular2-signaturepad';
import { StudentExamComponent } from './student-exam/student-exam.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    AddQuestionComponent,
    PreviewComponent,
    ProfileComponent,
    CorrectExamComponent,
    CorrectListComponent,
    EditProfileComponent,
    StudentExamComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    AppRoutingModule,
    HttpClientModule,
    SignaturePadModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
