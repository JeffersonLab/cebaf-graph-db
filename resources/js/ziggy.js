const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"data-sets.index":{"uri":"data-sets","methods":["GET","HEAD"]},"data-sets.create":{"uri":"data-sets\/create","methods":["GET","HEAD"]},"data-sets.store":{"uri":"data-sets","methods":["POST"]},"data-sets.show":{"uri":"data-sets\/{data_set}","methods":["GET","HEAD"]},"data-sets.edit":{"uri":"data-sets\/{data_set}\/edit","methods":["GET","HEAD"]},"data-sets.update":{"uri":"data-sets\/{data_set}","methods":["PUT","PATCH"]},"data-sets.destroy":{"uri":"data-sets\/{data_set}","methods":["DELETE"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
