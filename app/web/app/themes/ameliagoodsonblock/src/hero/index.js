import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';

registerBlockType(metadata.name, {
  edit: Edit
})

function Edit() {
  return (
    <div className="hero-content">
      <div className="hero-copy">
        <div className="hero-title">My hero</div>
        <div className="hero-subtitle contain-margins">Subtitle</div>
        <a className="button" href="#">See work</a>
      </div>
    </div>
  )
}



