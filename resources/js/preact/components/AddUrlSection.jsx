import axios from "axios"
import { useState } from "preact/hooks"

export default function AddUrlSection() {
  const [showModal, setShowModal] = useState(false)
  const [shortUrl, setShortUrl] = useState('')
  const [loading, setLoading] = useState(false)

  const [errors, setErrors] = useState([])

  const handleForm = (e)=> {
    e.preventDefault()

    setLoading(true)
    setErrors([])

    axios.post('/api/shorten', {
      url: e.target.url.value?.trim()
    }, { withCredentials: true })
    .then((response)=> {
      if (response.status == 200) {
        setShortUrl(response.data.short_url)

        setTimeout(()=> {
          window.location.reload()
        }, 2000)

        return
      }
      else {
        alert('Something wrong happened!')
      }
    })
    .catch(err => {
      let formattedErrors = []

      if (err.status == 422) {
        for (const field in err.response.data.errors) {
          if (Object.prototype.hasOwnProperty.call(err.response.data.errors, field)) {
            const error = err.response.data.errors[field];
            formattedErrors.push(error.at(0))
          }
        }

        setErrors(formattedErrors)
      }
    })
    .finally(()=> {
      setLoading(false)
    })
  }

  return (
    <>
        <button type="button" onClick={()=> setShowModal(! showModal)} className="p-1 text-sm bg-green-500 cursor-pointer">
          add url
        </button>

        {
          showModal && (
            <>
              <section 
                onClick={()=> setShowModal(! showModal)}
                className="fixed w-screen h-screen bg-zinc-900/40 backdrop-blur-sm left-0 top-0 z-2"
              ></section>

              <section className="fixed top-[100px] left-[50%] translate-x-[-50%] w-[40%] min-w-[300px] bg-zinc-200 p-2 rounded-md shadow-lg z-50">
                <h2 className="text-xl font-bold mb-2">
                    Add link
                </h2>

                <form action="" className="flex flex-col gap-3" onSubmit={(e)=> handleForm(e)}>
                  {
                    (errors.length > 0) && (
                      <ul className="p-2 rounded bg-red-500/60 border border-red-500 list-style">
                        {
                          errors.map((err, i)=> (
                            <li key={i}>
                              { err }
                            </li>
                          ))
                        }
                      </ul>
                    )
                  }
                  {
                    shortUrl && (
                      <label className="flex flex-col">
                        <span>short url</span>

                        <input 
                          name="short_url" 
                          type="url"
                          value={shortUrl}
                          className="bg-white outline-none px-3 py-1 rounded-md"
                          readOnly
                        />
                      </label>
                    )
                  }

                  <label className="flex flex-col">
                    <span>Link</span>

                    <input 
                      name="url"
                      id="url"
                      type="url"
                      placeholder="Type the url here..."
                      className="bg-white outline-none px-3 py-1 rounded-md"
                      disabled={loading}
                      required 
                    />
                  </label>

                  <button 
                    disabled={loading} 
                    type="submit" 
                    className="w-full rounded-md bg-blue-500 cursor-pointer px-3 text-base text-zinc-200"
                  >
                    { loading ? 'Loading' : 'make it short' }
                  </button>

                </form>
              </section>
            </>
          )
        }
    </>
  )
}
