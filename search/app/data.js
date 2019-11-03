

const apiURL = `https://topolitique.ch/beta/wp-json/wp/v2/`;

export const mediaURL = `${apiURL}media?type=attachment&per_page=20`
export const queryURL = `${apiURL}posts`


export async function getBackgroundImages () {
  const response = await fetch(mediaURL);
  let imgs = response.json();
  let finalImgs = [];
  /*imgs.forEach(info => {
    console.log(info.guid.rendered);
  });

  console.log(finalImgs);*/
  return finalImgs;
}

export const searchTheAPI = ({ query }) => {
  let properQuery = encodeURI(query);
  let url = `${queryURL}?search=${properQuery}`
  return fetch(url)
} 
