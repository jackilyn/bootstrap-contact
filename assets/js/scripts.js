var ScriptLoader = {
  libs: [],
  plugins: [],
  modules: [],
  
  require: function(src) {
    document.write('<script type="text/javascript" src="'+src+'"></script>');
  },
  load: function() {
    var scriptTags = document.getElementsByTagName("script");
    for(var i=0;i<scriptTags.length;i++) {
      if(scriptTags[i].src && scriptTags[i].src.match(/scripts\.js$/)) {
        var path = scriptTags[i].src.replace(/scripts\.js$/,'');
        for (var k=0; k<this.libs.length; k++) this.require(path + "lib/" + this.libs[k] + ".js");
        for (var k=0; k<this.plugins.length; k++) this.require(path + "plugins/" + this.plugins[k] + ".js");
        for (var k=0; k<this.modules.length; k++) this.require(path + "modules/" + this.modules[k] + ".js");
        this.require(path + "application.js");
        break;
      }
    }
  }
}

ScriptLoader.libs = ["less"];
ScriptLoader.plugins = [];
ScriptLoader.modules = [];

ScriptLoader.load();