import React from "react";

class SearchBar extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      value: ""
    };
    this.handleChange = this.handleChange.bind(this);
    this.handleSearch = this.handleSearch.bind(this);
  }

  handleChange(event) {
    this.setState({ value: event.target.value });
  }

  handleSearch(event) {
    event.preventDefault();
    this.props.setView("searchBarResultsList", null, this.state.value);
  }

  render() {
    return (
      <div className="searchBarContainer rounded-circle textFont">
        <form className="searchBarForm" onSubmit={this.handleSearch}>

          <div className="container">
            <input
              className="rounded-pill mx-1 searchBarInput"
              type="search"
              value={this.state.value}
              placeholder=" Search"
              onChange={this.handleChange} />
            {/* {<img className="searchIcon mx-1 mb-2" src="./image/searchIcon.png" alt="searchPicture" onClick={e => this.handleSearch(e)} />} */}
            {<img className="searchIcon" src="./image/searchIcon.png" alt="searchPicture" onClick={e => this.handleSearch(e)} />}

          </div>


        </form>
      </div>
    );
  }
}

export default SearchBar;
