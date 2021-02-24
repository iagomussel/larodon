
import 'bootstrap';
import Vue from 'vue';
import VueResource from 'vue-resource';



import $ from 'jquery';
window.jQuery = $;
window.$ = $;
import 'select2';

/* fazendo select2 responder a vuejs*/
Vue.directive('select2', {
  inserted(el) {
    $(el).on('select2:select', () => {
      const event = new Event('change', { bubbles: true, cancelable: true });
      el.dispatchEvent(event);
    });

    $(el).on('select2:unselect', () => {
      const event = new Event('change', { bubbles: true, cancelable: true })
      el.dispatchEvent(event)
    })
  },
});

import moment from 'moment';

window.moment = moment;

import BootstrapVue from 'bootstrap-vue'

import Datepicker from 'vuejs-datepicker';
Vue.component("vuejs-datepicker", Datepicker);

import PacienteListComponent from './components/pacienteList.vue';
Vue.component('hi-pacientelist', PacienteListComponent);

import DentistaListComponent from './components/dentistaList.vue';
Vue.component('hi-dentistalist', DentistaListComponent);
import ProcedimentoListComponent from './components/procedimentoList.vue';
Vue.component('hi-procedimentolist', ProcedimentoListComponent);
import ConvenioListComponent from './components/convenioList.vue';
Vue.component('hi-conveniolist', ConvenioListComponent);

import SchedulerComponent from './components/scheduler.vue';
Vue.component('hi-scheduler', SchedulerComponent);


Vue.use(BootstrapVue);
Vue.use(VueResource);

///FAZER SELECT2 ATUALIZAR OS DADOS DO VUE
Vue.directive('select2', {
  inserted(el) {
      $(el).on('select2:select', () => {
          const event = new Event('change', { bubbles: true, cancelable: true });
          el.dispatchEvent(event);
      });

      $(el).on('select2:unselect', () => {
          const event = new Event('change', {bubbles: true, cancelable: true})
          el.dispatchEvent(event)
      })
  },
});
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
$(() => {

  var vueall = new Vue({
    el: '#app'
  })

})

