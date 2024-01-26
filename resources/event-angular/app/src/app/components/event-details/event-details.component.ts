import { Component, OnInit } from '@angular/core';
import { DataService } from '../../../app/service/data.service';
import { ActivatedRoute } from '@angular/router';
import { environment } from '../../../environments/environment';
import { FormGroup, FormControl, Validators } from '@angular/forms';

@Component({
    selector: 'app-event-details',
    templateUrl: './event-details.component.html',
    styleUrl: './event-details.component.css'
})
export class EventDetailsComponent {
    event: any;
    slug: any;

    registerForm = new FormGroup({
        name: new FormControl('', Validators.required),
        address: new FormControl(''),
        age: new FormControl('',Validators.pattern("^[0-9]*$")),
        email: new FormControl('',Validators.required),
    });


    constructor(private route: ActivatedRoute, private dataService: DataService) { }
    upload_url = environment.upload_url
    ngOnInit() {
        this.slug = this.route.snapshot.params?.['slug'];
        this.getEventBySlug();
    }
    getEventBySlug() {
        this.dataService.getEventBySlug(this.slug).subscribe((res) => {
            this.event = res;
        });
    }

    get registerFormControl() {
        return this.registerForm.controls;
    }

    register() {
        console.log(this.registerFormControl.age)
        this.dataService.register(this.registerForm.value, this.slug).subscribe((res: any) => {
            if (res.success) {
                alert(res.message)
            } else if (!res.success) {
                alert(res.message)
            }
        });
    }
}