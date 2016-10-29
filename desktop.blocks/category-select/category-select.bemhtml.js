block('category-select')(
  js()(true),
  content()(function(){
  return {
    elem: 'input',
    tag: 'input',
    attrs: { type: 'hidden', name: this.ctx.name, value: '' }
  }
}));
