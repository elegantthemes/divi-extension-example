// External Dependencies
import $ from 'jquery';

// Internal Dependencies
import HelloWorld from './modules/HelloWorld/HelloWorld';
import CustomCtaFull from './modules/CustomCtaFull/CustomCtaFull';
import CustomCtaAllOptions from './modules/CustomCtaAllOptions/CustomCtaAllOptions';

$(window).on('et_builder_api_ready', (event, API) => {
  API.registerModule('dicm_hello_world', HelloWorld);
  API.registerModule('dicm_cta_vb', CustomCtaFull);
  API.registerModule('dicm_cta_all_options', CustomCtaAllOptions);
});
