import { render } from "preact"
import AddUrlSection from "./preact/components/AddUrlSection"

function RenderAddUrlSection() {
  const root = document.querySelector('#create-link')

  console.log(root);
  
  if (! root) {
    return
  }

  render(
    <AddUrlSection />,
    root,
  )
}

export default RenderAddUrlSection