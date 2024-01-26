import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule, Routes } from '@angular/router';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { EventComponent } from './components/event/event.component';

import { HttpClientModule } from '@angular/common/http';
import { EventDetailsComponent } from './components/event-details/event-details.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

const appRoutes : Routes = [
  {path: '', component:EventComponent},
  {path: 'event/:slug', component:EventDetailsComponent},
]

@NgModule({
  declarations: [
    AppComponent,
    EventComponent,
    EventDetailsComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    RouterModule.forRoot(appRoutes)
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
