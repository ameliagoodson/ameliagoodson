import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';

function Edit() {
    console.log('Hero block editor script loaded');
  return (
    <div>
      <p>This is some dummy text.</p>
    </div>
  );

}

registerBlockType(metadata.name, {
  edit: Edit
})

