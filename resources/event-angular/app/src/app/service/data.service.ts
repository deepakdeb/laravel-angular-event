import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class DataService {
  
  constructor(private httpclient: HttpClient) {}
  api_url = environment.api_url

  getEvents() {
    return this.httpclient.get(this.api_url+'events/');
  }
  getEventBySlug(slug:String) {
    return this.httpclient.get(this.api_url+'event/'+slug);
  }
  register(requestData : any , slug: String){
    return this.httpclient.post(this.api_url+'register/'+slug , requestData);
  }
}
