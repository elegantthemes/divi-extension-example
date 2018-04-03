// External Dependencies
import $ from 'jquery';

// Internal Dependencies
import modules from './modules';


$(window).on('et_builder_api_ready', (event, API) => {
  // Register custom modules
  API.registerModules(modules);
});
